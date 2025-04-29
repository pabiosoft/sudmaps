<?php

namespace App\DataFixtures;

use App\Entity\Owner;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\LocationFactory;
use App\Factory\OwnerFactory;
use App\Factory\LandmarkFactory;
use App\Factory\TagFactory;
use App\Factory\SavedLocationFactory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public function load(ObjectManager $manager): void
    {

        // ✅ Création d'un compte test dev@mo.com / pass
        $owner = new Owner();
        $owner->setUsername('dev');
        $owner->setEmail('dev@mo.com');
        $owner->setCreatedAt(new \DateTimeImmutable());
        $owner->setIsActif(true);
        $hashedPassword = $this->passwordHasher->hashPassword($owner, 'pass');
        $owner->setPassword($hashedPassword);
        $manager->persist($owner);

        // ✅ Création de 20 utilisateurs
        OwnerFactory::createMany(20);

        // ✅ Création de 35 lieux
        LocationFactory::createMany(35);
        TagFactory::createMany(30);
        LandmarkFactory::createMany(30);
        SavedLocationFactory::createMany(40);

        $manager->flush();
    }
}
