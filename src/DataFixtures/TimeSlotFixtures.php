<?php

namespace App\DataFixtures;

use App\Entity\Edition;
use App\Entity\HighSchool;
use App\Entity\Section;
use App\Entity\Timeslot;
use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use Fzaninotto\faker;
use App\Entity\Speaker;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TimeSlotFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $slots = ['9h30', '10h30', '11h30'];

        foreach ($slots as $slot) {
            $timeSlot = new Timeslot();
            $timeSlot->setLabel($slot);
            $manager->persist($timeSlot);
        }
        $manager->flush();
    }
}
