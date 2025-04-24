<?php

namespace App\Mapper\Tag;

use App\ApiResource\TagDto;
use App\Entity\Tag;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;

#[AsMapper(from: Tag::class, to: TagDto::class)]
class TagEntityToDtoMapper implements MapperInterface
{
    public function load(object $from, string $toClass, array $context): object
    {
        $entity = $from;
        assert($entity instanceof Tag);

        $dto = new TagDto();
        $dto->id = $entity->getId();

        return $dto;
    }

    public function populate(object $from, object $to, array $context): object
    {
        $entity = $from;
        $dto = $to;

        assert($entity instanceof Tag);
        assert($dto instanceof TagDto);

        $dto->name = $entity->getName();
        $dto->location = $entity->getLocation()?->getId();

        return $dto;
    }
}
