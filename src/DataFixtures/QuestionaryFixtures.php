<?php

namespace App\DataFixtures;

use App\Entity\Edition;
use Faker\Factory;
use DateTimeImmutable;
use App\Entity\Questionary;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManager;

class QuestionaryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $editions = $manager->getRepository(Edition::class)->findAll();
        $tab = [];
        foreach ($editions as $edition) {
            if ($edition->getYear() == 2023) {
                $id = $edition->getId();
            }
        }

        $edition = $manager->getRepository(Edition::class)->find($id);

        $faker = Factory::create('fr_FR');
        $questionary = new Questionary();
        $questionary->setName('Satisfaction');
        $questionary->setEdition($edition);
        $questionary->setCreatedAt(new DateTimeImmutable());
        $manager->persist($questionary);

        $manager->flush();
    }
}
