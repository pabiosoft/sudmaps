<?php

namespace App\Domain\Service;

use App\Entity\Owner;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\CustomCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

class AuthLogin extends AbstractAuthenticator
{
    public function __construct(
        private JWTTokenManagerInterface $jwtManager,
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $userPasswordHasher,
    ) {}

    public function supports(Request $request): ?bool
    {
        return $request->getPathInfo() === '/api/login' && $request->isMethod('POST');
    }

    public function authenticate(Request $request): Passport
    {
        $content = json_decode($request->getContent(), true);

        if (!isset($content['email'], $content['password'])) {
            throw new AuthenticationException('Email and password must be provided.');
        }

        $email = $content['email'];
        $password = $content['password'];

        $checkIdentifierFunction = function ($email_) {
            $user = $this->entityManager->getRepository(Owner::class)->findOneBy(['email' => $email_]);
            if (!$user) {
                throw new AuthenticationException('Email does not exist.');
            }

            return $user;
        };

        $checkPasswordFunction = function ($password_, Owner $user): bool {
            if (!$this->userPasswordHasher->isPasswordValid($user, $password_)) {
                throw new AuthenticationException('Incorrect password.');
            }

            return true;
        };

        return new Passport(
            new UserBadge($email, $checkIdentifierFunction),
            new CustomCredentials($checkPasswordFunction, $password)
        );
    }


    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): Response
    {
        $user = $token->getUser();

        /** @var Owner $forFindIdUser */
        $forFindIdUser = $this->entityManager->getRepository(Owner::class)->findOneBy(['email' => $user->getUserIdentifier()]);

        $payload = [
            'data' => [
                'user' => $user->getUserIdentifier(),
                'id' => $forFindIdUser->getId(),
                'uri' => "/api/users/" . $forFindIdUser->getId(),
            ],
        ];

        $generateToken = $this->jwtManager->createFromPayload($user, $payload);

        $data = [
            'success' => true,
            'message' => 'Authentication successful',
            'debug_jwt_ne_pas_m\'utiliser' => [
                'email' => $user->getUserIdentifier(),
                'id' => $forFindIdUser->getId(),
                'uri' => "/api/users/" . $forFindIdUser->getId(),
                'message'=> 'Tu dois reverse le token pour avoir la payload',
            ],
            'token' => $generateToken,
        ];

        return new JsonResponse($data);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): Response
    {
        $content = json_decode($request->getContent(), true);

        $data = [
            'success' => false,
            'message' => $exception->getMessage(),
            'info' => [
                'email' => $content['email'] ?? 'unknown',
            ],
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

}