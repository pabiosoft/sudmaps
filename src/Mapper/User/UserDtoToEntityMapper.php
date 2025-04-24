<?php

namespace App\Mapper\User;

use App\ApiResource\UserDto;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;

#[AsMapper(from: UserDto::class, to: User::class)]
class UserDtoToEntityMapper implements MapperInterface
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function load(object $from, string $toClass, array $context): object
    {
        $dto = $from;
        assert($dto instanceof UserDto);

        return $dto->id ? $this->userRepository->find($dto->id) : new User();
    }

    public function populate(object $from, object $to, array $context): object
    {
        $dto = $from;
        $entity = $to;

        assert($dto instanceof UserDto);
        assert($entity instanceof User);

        $entity->setUsername($dto->username);
        $entity->setEmail($dto->email);

        return $entity;
    }
}
