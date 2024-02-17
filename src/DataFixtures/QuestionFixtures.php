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
            ->setText('Pourquoi AltaVista, lancé en 1995, était-il considéré comme un moteur de recherche avancé pour son époque&nbsp;?')
            ->setPosition(1)
            ->setActive(true)
            ->setQuizz($this->getReference('quizz-histoire-du-web'));
        $manager->persist($question);
        $this->addReference('question-histoire-du-web-01', $question);

        $question = (new Question())
            ->setText('Quel protocole Tim Berners-Lee a-t-il introduit en 1990, fondamental pour le web&nbsp;?')
            ->setPosition(2)
            ->setActive(true)
            ->setQuizz($this->getReference('quizz-histoire-du-web'));
        $manager->persist($question);
        $this->addReference('question-histoire-du-web-02', $question);

        $question = (new Question())
            ->setText('Quel était le statut de Gopher en tant qu\'outil de recherche en 1993&nbsp;?')
            ->setPosition(3)
            ->setActive(true)
            ->setQuizz($this->getReference('quizz-histoire-du-web'));
        $manager->persist($question);
        $this->addReference('question-histoire-du-web-03', $question);

        $question = (new Question())
            ->setText('Qui a conceptualisé l\'idée d\'hypertexte dans "As We May Think" en 1945&nbsp;?')
            ->setPosition(4)
            ->setActive(true)
            ->setQuizz($this->getReference('quizz-histoire-du-web'));
        $manager->persist($question);
        $this->addReference('question-histoire-du-web-04', $question);

        $question = (new Question())
            ->setText('Quel logiciel développé par Apple en 1981 a permis la navigation par clics&nbsp;?')
            ->setPosition(5)
            ->setActive(true)
            ->setQuizz($this->getReference('quizz-histoire-du-web'));
        $manager->persist($question);
        $this->addReference('question-histoire-du-web-05', $question);

        $question = (new Question())
            ->setText('Qu\'est-ce que le XHTML et quelle était son ambition initiale&nbsp;?')
            ->setPosition(6)
            ->setActive(true)
            ->setQuizz($this->getReference('quizz-histoire-du-web'));
        $manager->persist($question);
        $this->addReference('question-histoire-du-web-06', $question);

        $question = (new Question())
            ->setText('Quel moteur de recherche, lancé en 1998, deviendra plus tard Bing&nbsp;?')
            ->setPosition(7)
            ->setActive(true)
            ->setQuizz($this->getReference('quizz-histoire-du-web'));
        $manager->persist($question);
        $this->addReference('question-histoire-du-web-07', $question);

        $question = (new Question())
            ->setText('Comment s\'appelait le premier navigateur web créé par Tim Berners-Lee&nbsp;?')
            ->setPosition(8)
            ->setActive(true)
            ->setQuizz($this->getReference('quizz-histoire-du-web'));
        $manager->persist($question);
        $this->addReference('question-histoire-du-web-08', $question);

        $question = (new Question())
            ->setText('Quel système a été le précurseur de l\'édition de texte en mode hypertexte en 1960&nbsp;?')
            ->setPosition(9)
            ->setActive(true)
            ->setQuizz($this->getReference('quizz-histoire-du-web'));
        $manager->persist($question);
        $this->addReference('question-histoire-du-web-09', $question);

        $question = (new Question())
            ->setText('Quelle version de HTML a tenté d\'introduire les feuilles de style en 1997&nbsp;?')
            ->setPosition(10)
            ->setActive(true)
            ->setQuizz($this->getReference('quizz-histoire-du-web'));
        $manager->persist($question);
        $this->addReference('question-histoire-du-web-10', $question);

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
