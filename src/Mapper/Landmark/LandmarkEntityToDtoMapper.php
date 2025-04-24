<?php

namespace App\Mapper\Landmark;

use App\ApiResource\LandmarkDto;
use App\Entity\Landmark;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;

#[AsMapper(from: Landmark::class, to: LandmarkDto::class)]
class LandmarkEntityToDtoMapper implements MapperInterface
{
    public function load(object $from, string $toClass, array $context): object
    {
        $entity = $from;
        assert($entity instanceof Landmark);

        $dto = new LandmarkDto();
        $dto->id = $entity->getId();

        return $dto;
    }

    public function populate(object $from, object $to, array $context): object
    {
        $entity = $from;
        $dto = $to;

        assert($entity instanceof Landmark);
        assert($dto instanceof LandmarkDto);

        $dto->label = $entity->getLabel();
        $dto->location = $entity->getLocation()?->getId();

        return $dto;
    }
}
