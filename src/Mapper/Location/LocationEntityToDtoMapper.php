<?php

namespace App\Mapper\Location;

use App\ApiResource\LocationDto;
use App\Entity\Location;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;

#[AsMapper(from: Location::class, to: LocationDto::class)]
class LocationEntityToDtoMapper implements MapperInterface
{
    public function load(object $from, string $toClass, array $context): object
    {
        $entity = $from;
        assert($entity instanceof Location);

        $dto = new LocationDto();
        $dto->id = $entity->getId();

        return $dto;
    }

    public function populate(object $from, object $to, array $context): object
    {
        $entity = $from;
        $dto = $to;

        assert($entity instanceof Location);
        assert($dto instanceof LocationDto);

        $dto->name = $entity->getName();
        $dto->description = $entity->getDescription();
        $dto->latitude = $entity->getLatitude();
        $dto->longitude = $entity->getLongitude();
        $dto->visibility = $entity->getVisibility();
        $dto->isActif = $entity->getIsActif();

        return $dto;
    }
}
