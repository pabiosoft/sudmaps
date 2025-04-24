<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\LocationFactory;
use App\Factory\OwnerFactory;
use App\Factory\LandmarkFactory;
use App\Factory\TagFactory;
use App\Factory\SavedLocationFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        OwnerFactory::createMany(10);
        LocationFactory::createMany(15);
        TagFactory::createMany(20);
        LandmarkFactory::createMany(20);
        SavedLocationFactory::createMany(30);

        $manager->flush();
    }
}
