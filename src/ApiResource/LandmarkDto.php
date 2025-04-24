<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Doctrine\Orm\State\Options;
use App\Entity\Landmark;
use App\State\EntityClassDtoStateProcessor;
use App\State\EntityToDtoStateProvider;

#[ApiResource(
    shortName: 'Landmark',
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Patch(),
        new Delete(openapi: false, security: 'is_granted("ROLE_ADMIN")'),
    ],
    provider: EntityToDtoStateProvider::class,
    processor: EntityClassDtoStateProcessor::class,
    stateOptions: new Options(entityClass: Landmark::class),
    paginationItemsPerPage: 10,
)]
class LandmarkDto extends BaseDto
{
    public ?string $label = null;

    // On utilisera une URI type "/api/locations/{id}" ou directement un UUID selon le mapping
    public ?string $location = null;
}
