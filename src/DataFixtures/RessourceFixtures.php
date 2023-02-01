<?php

namespace App\DataFixtures;

use App\Entity\Ressource;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class RessourceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ressources = [
            'photo_1' => 'hzefhiezhfzefu.html',
            'photo_2' => 'azdazdazd.html',
            'photo_3' => 'azdazd.html',
            'photo_4' => 'hzefhieazdazdazdzhfzefu.html',
            'photo_5' => 'hzefhieazdazdzhfzefu.html'
        ];

        foreach ($ressources as $key => $ressource) {
            $ressourceEntity = new Ressource();
            $ressourceEntity->setName($key);
            $ressourceEntity->setUrl($ressource);
            $ressourceEntity->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($ressourceEntity);
        }
        $manager->flush();
    }
}
