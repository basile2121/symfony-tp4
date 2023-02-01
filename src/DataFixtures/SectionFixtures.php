<?php

namespace App\DataFixtures;

use App\Entity\Edition;
use App\Entity\HighSchool;
use App\Entity\Section;
use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use Fzaninotto\faker;
use App\Entity\Speaker;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SectionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $sectionLabels = ['Seconde', 'Première', 'Terminal'];

        foreach ($sectionLabels as $label) {
            $highSchool = new Section();
            $highSchool->setLabel($label);
            $highSchool->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($highSchool);
        }
        $manager->flush();
    }
}
