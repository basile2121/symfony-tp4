<?php

namespace App\DataFixtures;

use App\Entity\UniversityRoom;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UniversityRoomFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $faker_us = Factory::create('en_US');
        // $product = new Product();
        // $manager->persist($product);
        for ($i = 1; $i <= 50; $i++) {
            $universityRoom = new UniversityRoom();
            $universityRoom->setName($faker->word(1, true));
            $universityRoom->setStage($faker->randomDigit);
            $universityRoom->setCapacity($faker->numberBetween(25, 33));
            $universityRoom->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($universityRoom);
        }
        $manager->flush();
    }
}
