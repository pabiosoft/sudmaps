<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Doctrine\Orm\State\Options;
use App\Entity\SavedLocation;
use App\State\EntityClassDtoStateProcessor;
use App\State\EntityToDtoStateProvider;

#[ApiResource(
    shortName: 'SavedLocation',
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Delete(openapi: false, security: 'is_granted("ROLE_ADMIN")'),
    ],
    provider: EntityToDtoStateProvider::class,
    processor: EntityClassDtoStateProcessor::class,
    stateOptions: new Options(entityClass: SavedLocation::class),
    paginationItemsPerPage: 10,
)]
class SavedLocationDto extends BaseDto
{
    public ?string $location = null;
    public ?string $user = null;
}
