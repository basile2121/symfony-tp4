<?php

namespace App\DataFixtures;

use DateTimeImmutable;
use App\Entity\Question;
use App\Entity\Questionary;
use App\Entity\PossibleAnswer;
use App\DataFixtures\AnswerFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\PossibleAnswerFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class QuestionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $possibleAnswer = $manager->getRepository(PossibleAnswer::class)->findOneBy(array('balise' => 'textarea'));
        $question = new Question();
        $question->setLabel('Comment avez-vous trouvé les ateliers ?');
        $question->addPossibleAnswer($possibleAnswer);
        $manager->persist($question);

        $answers = ['1', '2', '3', '4', '5'];
        $question = new Question();
        $question->setLabel('Quelle note donnerez-vous à la journée ?');
        foreach ($answers as $answer) {
            $possibleAnswer = $manager->getRepository(PossibleAnswer::class)->findOneBy(array('answer' => $answer));
            $question->addPossibleAnswer($possibleAnswer);
        }
        $manager->persist($question);

        $answers = ['oui', 'non'];
        $question = new Question();
        $question->setLabel('Avez-vous été satisfait de la journée ?');
        foreach ($answers as $answer) {
            $possibleAnswer = $manager->getRepository(PossibleAnswer::class)->findOneBy(array('answer' => $answer));
            $question->addPossibleAnswer($possibleAnswer);
        }
        $manager->persist($question);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PossibleAnswerFixtures::class,
        ];
    }
}
