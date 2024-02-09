<?php

namespace App\DataFixtures;

use App\Entity\Attempt;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AttemptFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $attempt = (new Attempt())
            ->setQuizz($this->getReference('quizz-js-fondamentaux'))
            ->setPlayer($this->getReference('user-nicolasvauche'))
            ->setScore(8)
            ->setEndedAt(new DateTimeImmutable('2021-10-01 12:00:00'));
        $manager->persist($attempt);
        $this->addReference('attempt-01', $attempt);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 8;
    }
}
