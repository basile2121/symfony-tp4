<?php

namespace App\DataFixtures;

use App\Entity\Job;
use App\Entity\Skill;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SkillFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $jobs = $manager->getRepository(Job::class)->findAll();

        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 100; $i++) {
            $skill = new Skill();
            $skill->setName($faker->word(1, true));
            $skill->addJob($jobs[array_rand($jobs)]);
            $manager->persist($skill);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            JobFixtures::class,
        ];
    }
}
