<?php

namespace App\DataFixtures;

use App\Entity\Skill;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SkillFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $faker_us = Factory::create('en_US');
        // $product = new Product();
        // $manager->persist($product);
        for ($i = 1; $i <= 50; $i++) {
            $universityRoom = new Skill();
            $universityRoom->setName($faker->word(1, true));
            $universityRoom->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($universityRoom);
        }
        $manager->flush();
    }
}
