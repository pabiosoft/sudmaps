<?php

namespace App\Factory;

use App\Entity\Location;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Location>
 */
final class LocationFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Location::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'name' => self::faker()->streetName(),
            'description' => self::faker()->sentence(),
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'latitude' => self::faker()->randomFloat(),
            'longitude' => self::faker()->randomFloat(),
            'visibility' => self::faker()->randomElement(['public', 'private']),
            'isActif' => true,
            'owner' => OwnerFactory::new(), // 👈 lien automatique avec un Owner généré
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Location $location): void {})
        ;
    }
}
