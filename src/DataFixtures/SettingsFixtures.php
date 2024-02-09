<?php

namespace App\DataFixtures;

use App\Entity\Settings;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SettingsFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $settings = (new Settings())
            ->setQuizzQuestionsMax(10)
            ->setQuizzAnswersMax(4);
        $manager->persist($settings);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 9;
    }
}
