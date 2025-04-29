<?php

namespace App\Mapper\Owner;

use App\ApiResource\OwnerDto;
use App\Entity\Owner;
use App\Repository\OwnerRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;

#[AsMapper(from: OwnerDto::class, to: Owner::class)]
class OwnerDtoToEntityMapper implements MapperInterface
{
    public function __construct(
        private OwnerRepository $userRepository,
        private UserPasswordHasherInterface $passwordHasher,
    ) {}

    public function load(object $from, string $toClass, array $context): object
    {
        $dto = $from;
        assert($dto instanceof OwnerDto);

        return $dto->id ? $this->userRepository->find($dto->id) : new Owner();
    }

    public function populate(object $from, object $to, array $context): object
    {
        $dto = $from;
        $entity = $to;

        assert($dto instanceof OwnerDto);
        assert($entity instanceof Owner);

        $entity->setUsername($dto->username);
        $entity->setEmail($dto->email);

        if ($dto->password !== null) {
            $hashed = $this->passwordHasher->hashPassword($entity, $dto->password);
            $entity->setPassword($hashed);
        }

        return $entity;
    }
}
