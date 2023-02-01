<?php

namespace App\DataFixtures;

use App\Entity\Edition;
use App\Entity\HighSchool;
use App\Entity\Registration;
use App\Entity\Section;
use App\Entity\Student;
use App\Entity\Timeslot;
use App\Entity\Workshop;
use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use Fzaninotto\faker;
use App\Entity\Speaker;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class RegistrationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $workshops = $manager->getRepository(Workshop::class)->findAll();
        $students = $manager->getRepository(Student::class)->findAll();
        $slots = $manager->getRepository(Timeslot::class)->findAll();

        for ($i = 1; $i <= 50; $i++) {
            $registration = new Registration();
            $registration->setStudent($students[array_rand($students)]);
            $registration->setTimeslot($slots[array_rand($slots)]);
            $registration->setWorkshop($workshops[array_rand($workshops)]);
            $registration->setRegisterAt(new \DateTimeImmutable());
            $manager->persist($registration);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            WorkShopFixtures::class,
            StudentFixtures::class,
            TimeSlotFixtures::class
        ];
    }
}
