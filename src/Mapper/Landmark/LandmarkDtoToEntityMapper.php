<?php

namespace App\Mapper\Landmark;

use App\ApiResource\LandmarkDto;
use App\Entity\Landmark;
use App\Repository\LandmarkRepository;
use App\Repository\LocationRepository;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;

#[AsMapper(from: LandmarkDto::class, to: Landmark::class)]
class LandmarkDtoToEntityMapper implements MapperInterface
{
    public function __construct(
        private LandmarkRepository $landmarkRepository,
        private LocationRepository $locationRepository
    ) {}

    public function load(object $from, string $toClass, array $context): object
    {
        $dto = $from;
        assert($dto instanceof LandmarkDto);

        return $dto->id ? $this->landmarkRepository->find($dto->id) : new Landmark();
    }

    public function populate(object $from, object $to, array $context): object
    {
        $dto = $from;
        $entity = $to;

        assert($dto instanceof LandmarkDto);
        assert($entity instanceof Landmark);

        $entity->setLabel($dto->label);
        
        if ($dto->location) {
            $location = $this->locationRepository->find($dto->location);
            $entity->setLocation($location);
        }

        return $entity;
    }
}
