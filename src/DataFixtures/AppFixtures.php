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

        OwnerFactory::createMany(20);
        LocationFactory::createMany(35);
        TagFactory::createMany(30);
        LandmarkFactory::createMany(30);
        SavedLocationFactory::createMany(40);

        $manager->flush();
    }
}
