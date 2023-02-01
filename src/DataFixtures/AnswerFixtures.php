<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use DateTimeImmutable;
use App\Entity\Question;
use App\DataFixtures\QuestionFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AnswerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $question = $manager->getRepository(Question::class)->findOneBy(array('label' => 'Comment avez-vous trouvé les ateliers ?'));
        $answer = new Answer();
        $answer->setLabel('Les ateliers ont été d\'une qualité incroyable, je n\'en reviens pas ! Je n\'ai rien à ajouter!');
        $answer->setQuestion($question);
        $manager->persist($answer);

        $question = $manager->getRepository(Question::class)->findOneBy(array('label' => 'Comment avez-vous trouvé les ateliers ?'));
        $answer = new Answer();
        $answer->setLabel('Rien à dire, parfait!');
        $answer->setQuestion($question);
        $manager->persist($answer);

        $question = $manager->getRepository(Question::class)->findOneBy(array('label' => 'Quelle note donnerez-vous à la journée ?'));
        $answer = new Answer();
        $answer->setLabel('4');
        $answer->setQuestion($question);
        $manager->persist($answer);

        $question = $manager->getRepository(Question::class)->findOneBy(array('label' => 'Quelle note donnerez-vous à la journée ?'));
        $answer = new Answer();
        $answer->setLabel('3');
        $answer->setQuestion($question);
        $manager->persist($answer);

        $question = $manager->getRepository(Question::class)->findOneBy(array('label' => 'Quelle note donnerez-vous à la journée ?'));
        $answer = new Answer();
        $answer->setLabel('5');
        $answer->setQuestion($question);
        $manager->persist($answer);

        $question = $manager->getRepository(Question::class)->findOneBy(array('label' => 'Avez-vous été satisfait de la journée ?'));
        $answer = new Answer();
        $answer->setLabel('oui');
        $answer->setQuestion($question);
        $manager->persist($answer);

        $question = $manager->getRepository(Question::class)->findOneBy(array('label' => 'Avez-vous été satisfait de la journée ?'));
        $answer = new Answer();
        $answer->setLabel('non');
        $answer->setQuestion($question);
        $manager->persist($answer);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            QuestionFixtures::class,
        ];
    }
}
