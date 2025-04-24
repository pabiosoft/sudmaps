<?php

namespace App\Mapper\SavedLocation;

use App\ApiResource\SavedLocationDto;
use App\Entity\SavedLocation;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;

#[AsMapper(from: SavedLocation::class, to: SavedLocationDto::class)]
class SavedLocationEntityToDtoMapper implements MapperInterface
{
    public function load(object $from, string $toClass, array $context): object
    {
        $entity = $from;
        assert($entity instanceof SavedLocation);

        $dto = new SavedLocationDto();
        $dto->id = $entity->getId();

        return $dto;
    }

    public function populate(object $from, object $to, array $context): object
    {
        $entity = $from;
        $dto = $to;

        assert($entity instanceof SavedLocation);
        assert($dto instanceof SavedLocationDto);

        $dto->location = $entity->getLocation()?->getId();
        $dto->user = $entity->getOwner()?->getId();

        return $dto;
    }
}
