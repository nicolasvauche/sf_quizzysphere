<?php

namespace App\DataFixtures;

use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class QuestionFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $question = (new Question())
            ->setText('Qui est le créateur de JavaScript et en quelle année a-t-il été lancé&nbsp;?')
            ->setPosition(1)
            ->setActive(true)
            ->setQuizz($this->getReference('quizz-js-fondamentaux'));
        $manager->persist($question);
        $this->addReference('question-js-fondamentaux-01', $question);

        $question = (new Question())
            ->setText('Que signifie le fait que JavaScript a un "typage faible"&nbsp;?')
            ->setPosition(2)
            ->setActive(true)
            ->setQuizz($this->getReference('quizz-js-fondamentaux'));
        $manager->persist($question);
        $this->addReference('question-js-fondamentaux-02', $question);

        $question = (new Question())
            ->setText('Quelle est la particularité d\'une variable définie avec let en JavaScript&nbsp;?')
            ->setPosition(3)
            ->setActive(true)
            ->setQuizz($this->getReference('quizz-js-fondamentaux'));
        $manager->persist($question);
        $this->addReference('question-js-fondamentaux-03', $question);

        $question = (new Question())
            ->setText('Quel est l\'effet de l\'utilisation de const pour déclarer une variable en JavaScript&nbsp;?')
            ->setPosition(4)
            ->setActive(true)
            ->setQuizz($this->getReference('quizz-js-fondamentaux'));
        $manager->persist($question);
        $this->addReference('question-js-fondamentaux-04', $question);

        $question = (new Question())
            ->setText('Quelle déclaration sur les types primitifs en JavaScript est vraie&nbsp;?')
            ->setPosition(5)
            ->setActive(true)
            ->setQuizz($this->getReference('quizz-js-fondamentaux'));
        $manager->persist($question);
        $this->addReference('question-js-fondamentaux-05', $question);

        $question = (new Question())
            ->setText('Quel est le rôle de la norme ECMAScript en relation avec JavaScript&nbsp;?')
            ->setPosition(6)
            ->setActive(true)
            ->setQuizz($this->getReference('quizz-js-fondamentaux'));
        $manager->persist($question);
        $this->addReference('question-js-fondamentaux-06', $question);

        $question = (new Question())
            ->setText('Qu\'est-ce que la Temporal Dead Zone (TDZ) en JavaScript&nbsp;?')
            ->setPosition(7)
            ->setActive(true)
            ->setQuizz($this->getReference('quizz-js-fondamentaux'));
        $manager->persist($question);
        $this->addReference('question-js-fondamentaux-07', $question);

        $question = (new Question())
            ->setText('Quel est le comportement de JavaScript lorsqu\'il rencontre une variable non définie dans le scope actuel&nbsp;?')
            ->setPosition(8)
            ->setActive(true)
            ->setQuizz($this->getReference('quizz-js-fondamentaux'));
        $manager->persist($question);
        $this->addReference('question-js-fondamentaux-08', $question);

        $question = (new Question())
            ->setText('Quelle est la différence principale entre une fonction déclarée et une expression de fonction en JavaScript&nbsp;?')
            ->setPosition(9)
            ->setActive(true)
            ->setQuizz($this->getReference('quizz-js-fondamentaux'));
        $manager->persist($question);
        $this->addReference('question-js-fondamentaux-09', $question);

        $question = (new Question())
            ->setText('Que signifie l\'opérateur de spread ... en JavaScript&nbsp;?')
            ->setPosition(10)
            ->setActive(true)
            ->setQuizz($this->getReference('quizz-js-fondamentaux'));
        $manager->persist($question);
        $this->addReference('question-js-fondamentaux-10', $question);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 6;
    }
}
