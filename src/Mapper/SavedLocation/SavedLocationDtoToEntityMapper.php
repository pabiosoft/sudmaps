<?php

namespace App\Mapper\SavedLocation;

use App\ApiResource\SavedLocationDto;
use App\Entity\SavedLocation;
use App\Repository\LocationRepository;
use App\Repository\SavedLocationRepository;
use App\Repository\UserRepository;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;

#[AsMapper(from: SavedLocationDto::class, to: SavedLocation::class)]
class SavedLocationDtoToEntityMapper implements MapperInterface
{
    public function __construct(
        private SavedLocationRepository $savedLocationRepository,
        private LocationRepository $locationRepository,
        private UserRepository $userRepository
    ) {}

    public function load(object $from, string $toClass, array $context): object
    {
        $dto = $from;
        assert($dto instanceof SavedLocationDto);

        return $dto->id ? $this->savedLocationRepository->find($dto->id) : new SavedLocation();
    }

    public function populate(object $from, object $to, array $context): object
    {
        $dto = $from;
        $entity = $to;

        assert($dto instanceof SavedLocationDto);
        assert($entity instanceof SavedLocation);

        if ($dto->location) {
            $location = $this->locationRepository->find($dto->location);
            $entity->setLocation($location);
        }

        if ($dto->user) {
            $user = $this->userRepository->find($dto->user);
            $entity->setOwner($user);
        }

        return $entity;
    }
}
