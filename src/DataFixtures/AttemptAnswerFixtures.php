<?php

namespace App\DataFixtures;

use App\Entity\AttemptAnswer;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AttemptAnswerFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $attemptAnswer = (new AttemptAnswer())
            ->setAttempt($this->getReference('attempt-01'))
            ->setQuestion($this->getReference('question-js-fondamentaux-01'))
            ->setAnswer($this->getReference('answer-js-fondamentaux-01-02'))
            ->setScore(1)
            ->setEndedAt(new DateTimeImmutable('2021-01-01 00:01:00'));
        $manager->persist($attemptAnswer);

        $attemptAnswer = (new AttemptAnswer())
            ->setAttempt($this->getReference('attempt-01'))
            ->setQuestion($this->getReference('question-js-fondamentaux-02'))
            ->setAnswer($this->getReference('answer-js-fondamentaux-02-01'))
            ->setEndedAt(new DateTimeImmutable('2021-01-01 00:01:00'));
        $manager->persist($attemptAnswer);

        $attemptAnswer = (new AttemptAnswer())
            ->setAttempt($this->getReference('attempt-01'))
            ->setQuestion($this->getReference('question-js-fondamentaux-03'))
            ->setAnswer($this->getReference('answer-js-fondamentaux-03-03'))
            ->setScore(1)
            ->setEndedAt(new DateTimeImmutable('2021-01-01 00:01:00'));
        $manager->persist($attemptAnswer);

        $attemptAnswer = (new AttemptAnswer())
            ->setAttempt($this->getReference('attempt-01'))
            ->setQuestion($this->getReference('question-js-fondamentaux-04'))
            ->setAnswer($this->getReference('answer-js-fondamentaux-04-01'))
            ->setScore(1)
            ->setEndedAt(new DateTimeImmutable('2021-01-01 00:01:00'));
        $manager->persist($attemptAnswer);

        $attemptAnswer = (new AttemptAnswer())
            ->setAttempt($this->getReference('attempt-01'))
            ->setQuestion($this->getReference('question-js-fondamentaux-05'))
            ->setAnswer($this->getReference('answer-js-fondamentaux-05-02'))
            ->setEndedAt(new DateTimeImmutable('2021-01-01 00:01:00'));
        $manager->persist($attemptAnswer);

        $attemptAnswer = (new AttemptAnswer())
            ->setAttempt($this->getReference('attempt-01'))
            ->setQuestion($this->getReference('question-js-fondamentaux-06'))
            ->setAnswer($this->getReference('answer-js-fondamentaux-06-04'))
            ->setEndedAt(new DateTimeImmutable('2021-01-01 00:01:00'));
        $manager->persist($attemptAnswer);

        $attemptAnswer = (new AttemptAnswer())
            ->setAttempt($this->getReference('attempt-01'))
            ->setQuestion($this->getReference('question-js-fondamentaux-07'))
            ->setAnswer($this->getReference('answer-js-fondamentaux-07-02'))
            ->setScore(1)
            ->setEndedAt(new DateTimeImmutable('2021-01-01 00:01:00'));
        $manager->persist($attemptAnswer);

        $attemptAnswer = (new AttemptAnswer())
            ->setAttempt($this->getReference('attempt-01'))
            ->setQuestion($this->getReference('question-js-fondamentaux-08'));
        $manager->persist($attemptAnswer);

        $attemptAnswer = (new AttemptAnswer())
            ->setAttempt($this->getReference('attempt-01'))
            ->setQuestion($this->getReference('question-js-fondamentaux-09'));
        $manager->persist($attemptAnswer);

        $attemptAnswer = (new AttemptAnswer())
            ->setAttempt($this->getReference('attempt-01'))
            ->setQuestion($this->getReference('question-js-fondamentaux-10'));
        $manager->persist($attemptAnswer);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 9;
    }
}
