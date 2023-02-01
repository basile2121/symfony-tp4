<?php

namespace App\DataFixtures;

use App\Entity\Edition;
use App\Entity\Job;
use App\Entity\Question;
use App\Entity\Sector;
use App\Entity\UniversityRoom;
use App\Entity\Workshop;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use DateTimeImmutable;
use App\Entity\Questionary;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManager;

class JobFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $workShops = $manager->getRepository(Workshop::class)->findAll();

        for ($i = 1; $i <= 150; $i++) {
            $job = new Job();
            $job->setName('Job numéro ' . $i);
            $job->setWorkshop($workShops[array_rand($workShops)]);
            $manager->persist($job);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            WorkShopFixtures::class,
        ];
    }
}
