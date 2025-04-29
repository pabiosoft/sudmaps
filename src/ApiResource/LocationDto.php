<?php

namespace App\ApiResource;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\ApiResource\partial\OwnerMiniDto;
use App\Entity\Location;
use App\State\EntityClassDtoStateProcessor;
use App\State\EntityToDtoStateProvider;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ApiResource(
    shortName: 'Location',
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Patch(),
        new Delete(
            openapi:false,
            security: 'is_granted("ROLE_ADMIN")',
        )
    ],
    paginationItemsPerPage: 10,
    provider: EntityToDtoStateProvider::class,
    processor: EntityClassDtoStateProcessor::class,
    stateOptions: new Options(entityClass: Location::class),
)]
#[ApiFilter(BooleanFilter::class, properties: ['isActif'])]
class LocationDto extends BaseDto
{
    public ?string $name = null;
    public ?string $description = null;

    public float $latitude;
    public float $longitude;

    public ?string $visibility = null;

    #[ApiProperty(writable: false)]
    public ?OwnerDto $owner = null; // 👈 ici l'objet complet
}