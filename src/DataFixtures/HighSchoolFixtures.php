<?php

namespace App\DataFixtures;

use App\Entity\Edition;
use App\Entity\HighSchool;
use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use Fzaninotto\faker;
use App\Entity\Speaker;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class HighSchoolFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $highSchoolNames = ['Montalembert', 'Notre-Dame', 'Georges Brassens', 'Hoche', 'Georges Leven'];

        foreach ($highSchoolNames as $name) {
            $highSchool = new HighSchool();
            $highSchool->setName($name);
            $manager->persist($highSchool);
        }
        $manager->flush();
    }
}
