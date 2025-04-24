<?php

namespace App\Mapper\Owner;

use App\ApiResource\OwnerDto;
use App\Entity\Owner;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;

#[AsMapper(from: Owner::class, to: OwnerDto::class)]
class OwnerEntityToDtoMapper implements MapperInterface
{
    public function load(object $from, string $toClass, array $context): object
    {
        $entity = $from;
        assert($entity instanceof Owner);

        $dto = new OwnerDto();
        $dto->id = $entity->getId();

        return $dto;
    }

    public function populate(object $from, object $to, array $context): object
    {
        $entity = $from;
        $dto = $to;

        assert($entity instanceof Owner);
        assert($dto instanceof OwnerDto);

        $dto->username = $entity->getUsername();
        $dto->email = $entity->getEmail();

        return $dto;
    }
}
