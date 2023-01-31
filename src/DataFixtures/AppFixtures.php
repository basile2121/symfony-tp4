<?php

namespace App\DataFixtures;

use App\Entity\Edition;
use App\Entity\Speaker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Fzaninotto\faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = faker::create('fr_FR');
        
        // //create edition
        // $edition = new Edition();
        // $edition->setYear(2023);
        // $manager->persist($edition);

        // create 10 Speaker
        for ($i = 0; $i < 10; $i++) {
            $speaker = new Speaker();
            $speaker->setFirstName($faker->name);
            $speaker->setLastName($faker->lastName);
            $speaker->setMail($faker->email);
            $speaker->setPhone($faker->num);
            $speaker->setCompagny($faker->lastName);
            $manager->persist($speaker);

        }



       

        $manager->flush();
    }
}
