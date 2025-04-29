<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Doctrine\Orm\State\Options;
use App\Entity\Owner;
use App\State\EntityClassDtoStateProcessor;
use App\State\EntityToDtoStateProvider;

#[ApiResource(
    shortName: 'User',
    operations: [
        new Get(),
        new GetCollection(),
        new Post(
            description: 'Créer un nouvel utilisateur (inscription)',
        ),
        new Patch(),
        new Delete(openapi: false, security: 'is_granted("ROLE_ADMIN")'),
    ],
    paginationItemsPerPage: 10,
    provider: EntityToDtoStateProvider::class,
    processor: EntityClassDtoStateProcessor::class,
    stateOptions: new Options(entityClass: Owner::class),
)]
class OwnerDto extends BaseDto
{
    public ?string $username = null;
    public ?string $email = null;

    #[ApiProperty(readable: false)]
    public ?string $password = null;
}
