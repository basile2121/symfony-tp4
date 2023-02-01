<?php

namespace App\DataFixtures;

use DateTimeImmutable;
use App\Entity\PossibleAnswer;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PossibleAnswerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $answers = ['1', '2', '3', '4', '5', 'non', 'oui'];

        foreach ($answers as $answer) {
            $possibleAnswer = new PossibleAnswer();
            $possibleAnswer->setBalise('input');
            $possibleAnswer->setType('radio');
            $possibleAnswer->setAnswer($answer);
            $manager->persist($possibleAnswer);
        }

        $possibleAnswer = new PossibleAnswer();
        $possibleAnswer->setBalise('textarea');
        $manager->persist($possibleAnswer);

        $manager->flush();
    }
}
