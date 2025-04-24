<?php

namespace App\Mapper\Tag;

use App\ApiResource\TagDto;
use App\Entity\Tag;
use App\Repository\LocationRepository;
use App\Repository\TagRepository;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;

#[AsMapper(from: TagDto::class, to: Tag::class)]
class TagDtoToEntityMapper implements MapperInterface
{
    public function __construct(
        private TagRepository $tagRepository,
        private LocationRepository $locationRepository
    ) {}

    public function load(object $from, string $toClass, array $context): object
    {
        $dto = $from;
        assert($dto instanceof TagDto);

        return $dto->id ? $this->tagRepository->find($dto->id) : new Tag();
    }

    public function populate(object $from, object $to, array $context): object
    {
        $dto = $from;
        $entity = $to;

        assert($dto instanceof TagDto);
        assert($entity instanceof Tag);

        $entity->setName($dto->name);

        if ($dto->location) {
            $location = $this->locationRepository->find($dto->location);
            $entity->setLocation($location);
        }

        return $entity;
    }
}
