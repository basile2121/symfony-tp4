<?php

namespace App\DataFixtures;

use App\Entity\Edition;
use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use Fzaninotto\faker;
use App\Entity\Speaker;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SpeakerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $faker_us = Factory::create('en_US');
        $editions = $manager->getRepository(Edition::class)->findAll();

        // $product = new Product();
        // $manager->persist($product);
        for ($i = 1; $i <= 20; $i++) {
            $speaker = new Speaker();
            $speaker->setFirstName($faker->firstName);
            $speaker->setLastName($faker->lastName);
            $speaker->setMail($faker->email);
            $speaker->setPhone('0675842651');
            $speaker->setCompagny($faker_us->company());
            $speaker->setCreatedAt(new \DateTimeImmutable());
            $speaker->addEdition($editions[array_rand($editions)]);
            $manager->persist($speaker);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            EditionFixtures::class,
        ];
    }
}
