<?php

namespace App\DataFixtures;

use Faker\Factory;
use DateTimeImmutable;
use App\Entity\Activity;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ActivityFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $faker_us = Factory::create('en_US');
        // $product = new Product();
        // $manager->persist($product);
        for ($i = 1; $i <= 50; $i++) {
            $activity = new Activity();
            $activity->setName($faker->word(1, true));
            $activity->setCreatedAt(new DateTimeImmutable());
            $manager->persist($activity);
        }
        $manager->flush();
    }
}
