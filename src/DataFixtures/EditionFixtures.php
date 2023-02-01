<?php

namespace App\DataFixtures;

use DateTimeImmutable;
use App\Entity\Edition;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EditionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 2019; $i <= 2024; $i++) {
            $edition = new Edition();
            $edition->setYear($i);
            $manager->persist($edition);
        }
        $manager->flush();
    }
}
