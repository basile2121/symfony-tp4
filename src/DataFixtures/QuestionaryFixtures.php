<?php

namespace App\DataFixtures;

use App\Entity\Edition;
use App\Entity\Question;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use DateTimeImmutable;
use App\Entity\Questionary;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManager;

class QuestionaryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $edition = $manager->getRepository(Edition::class)->findOneBy(['year' => 2023]);
        $question1 = $manager->getRepository(Question::class)->findOneBy(array('label' => 'Comment avez-vous trouvé les ateliers ?'));
        $question2 = $manager->getRepository(Question::class)->findOneBy(array('label' => 'Quelle note donnerez-vous à la journée ?'));
        $question3 = $manager->getRepository(Question::class)->findOneBy(array('label' => 'Avez-vous été satisfait de la journée ?'));

        $questionary = new Questionary();
        $questionary->setName('Satisfaction');
        $questionary->setEdition($edition);
        $questionary->addQuestion($question1);
        $questionary->addQuestion($question2);
        $questionary->addQuestion($question3);
        $manager->persist($questionary);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            QuestionFixtures::class,
        ];
    }
}
