<?php

namespace App\DataFixtures;

use DateTime;
use Faker\Factory;
use Fzaninotto\faker;
use App\Entity\Speaker;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SpeakerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $faker_us = Factory::create('en_US');
        // $product = new Product();
        // $manager->persist($product);
        for ($i = 1; $i <= 50; $i++) {
            $speaker = new Speaker();
            $speaker->setFirstName($faker->firstName);
            $speaker->setLastName($faker->firstName);
            $speaker->setMail($faker->email);
            $speaker->setPhone('0675842651');
            $speaker->setCompagny($faker_us->company());
            $speaker->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($speaker);
        }
        $manager->flush();
    }
}
