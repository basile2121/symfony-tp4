<?php

namespace App\DataFixtures;

use App\Entity\Job;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use DateTimeImmutable;
use App\Entity\Activity;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ActivityFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $jobs = $manager->getRepository(Job::class)->findAll();

        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 100; $i++) {
            $activity = new Activity();
            $activity->setName($faker->word(1, true));
            $activity->addJob($jobs[array_rand($jobs)]);
            $manager->persist($activity);
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
