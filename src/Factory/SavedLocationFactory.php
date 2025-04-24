<?php

namespace App\Factory;

use App\Entity\SavedLocation;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use App\Factory\OwnerFactory;

/**
 * @extends PersistentProxyObjectFactory<SavedLocation>
 */
final class SavedLocationFactory extends PersistentProxyObjectFactory
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
        return SavedLocation::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'owner' => OwnerFactory::randomOrCreate(),
            'location' => LocationFactory::randomOrCreate(),
            'savedAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTimeBetween('-1 year', 'now')),
            'isActif' => true,        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(SavedLocation $savedLocation): void {})
        ;
    }
}
