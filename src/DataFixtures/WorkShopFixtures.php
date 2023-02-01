<?php

namespace App\DataFixtures;

use App\Entity\Edition;
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

class WorkShopFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $secteurs = $manager->getRepository(Sector::class)->findAll();
        $edition = $manager->getRepository(Edition::class)->findOneBy(['year' => 2023]);
        $universityRooms = $manager->getRepository(UniversityRoom::class)->findAll();


        foreach ($universityRooms as $universityRoom) {
            $workShop = new Workshop();
            $workShop->setName('Atelier de ' . $universityRoom->getName());
            $workShop->setSector($secteurs[array_rand($secteurs)]);
            $workShop->setEdition($edition);
            $workShop->setUniversityRoom($universityRoom);
            $workShop->setCreatedAt(new DateTimeImmutable());
            $manager->persist($workShop);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UniversityRoomFixtures::class,
            EditionFixtures::class,
            SectorFixtures::class
        ];
    }
}
