<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Sector;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SectorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $faker_us = Factory::create('en_US');
        // $product = new Product();
        // $manager->persist($product);
        for ($i = 1; $i <= 50; $i++) {
            $sector = new Sector();
            $sector->setName($faker->word(1, true));
            $sector->setDescription('Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officiis laborum impedit harum culpa praesentium optio.');
            $sector->setCreatedAt(new DateTimeImmutable());
            $manager->persist($sector);
        }
        $manager->flush();
    }
}
