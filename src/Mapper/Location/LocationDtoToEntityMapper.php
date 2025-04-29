<?php

namespace App\Mapper\Location;

use App\ApiResource\LocationDto;
use App\Entity\Location;
use App\Repository\LocationRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;

#[AsMapper(from: LocationDto::class, to: Location::class)]
class LocationDtoToEntityMapper implements MapperInterface
{
    public function __construct(
        private LocationRepository $locationRepository,
        private Security $security
    ) {}

    public function load(object $from, string $toClass, array $context): object
    {
        $dto = $from;
        assert($dto instanceof LocationDto);

        return $dto->id ? $this->locationRepository->find($dto->id) : new Location();
    }

    public function populate(object $from, object $to, array $context): object
    {
        $dto = $from;
        $entity = $to;

        assert($dto instanceof LocationDto);
        assert($entity instanceof Location);

        $entity->setName($dto->name);
        $entity->setDescription($dto->description);
        $entity->setLatitude($dto->latitude);
        $entity->setLongitude($dto->longitude);
        $entity->setVisibility($dto->visibility);

        // ✅ Lier automatiquement l'utilisateur connecté
        if (null === $entity->getOwner()) {
            $entity->setOwner($this->security->getUser());
        }

        return $entity;
    }
}
