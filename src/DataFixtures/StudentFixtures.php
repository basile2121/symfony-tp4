<?php

namespace App\DataFixtures;

use App\Entity\Edition;
use App\Entity\HighSchool;
use App\Entity\Section;
use App\Entity\Student;
use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use Fzaninotto\faker;
use App\Entity\Speaker;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class StudentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $highSchools = $manager->getRepository(HighSchool::class)->findAll();
        $sections = $manager->getRepository(Section::class)->findAll();

        // $product = new Product();
        // $manager->persist($product);
        for ($i = 1; $i <= 20; $i++) {
            $student = new Student();
            $student->setFirstName($faker->firstName);
            $student->setLastName($faker->lastName);
            $student->setPhone('0675842651');
            $student->setSection($sections[array_rand($sections)]);
            $student->setHighSchool($highSchools[array_rand($highSchools)]);
            $student->setEmail($faker->email);
            $student->setType('student');
            $student->setPassword('test');
            $student->setRoles(['ROLE_USER']);
            $manager->persist($student);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SectionFixtures::class,
            RessourceFixtures::class,
        ];
    }
}
