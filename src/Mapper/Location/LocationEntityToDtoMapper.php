<?php

namespace App\Mapper\Location;

use App\ApiResource\LocationDto;
use App\ApiResource\OwnerDto;
use App\Entity\Location;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;
use Symfonycasts\MicroMapper\MicroMapperInterface;

#[AsMapper(from: Location::class, to: LocationDto::class)]
class LocationEntityToDtoMapper implements MapperInterface
{
    public function __construct(private MicroMapperInterface $microMapper) {}

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

        if ($entity->getOwner()) {
            $dto->owner = $this->microMapper->map($entity->getOwner(), OwnerDto::class, [
                MicroMapperInterface::MAX_DEPTH => 1
            ]);
        }



        return $dto;
    }
}
