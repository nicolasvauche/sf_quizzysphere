<?php

namespace App\DataFixtures;

use App\Entity\QuizzCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class QuizzCategoryFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $quizzCategory = (new QuizzCategory())
            ->setName('Informatique')
            ->setCover('informatique657d8c8b5830f.png')
            ->setActive(true);
        $manager->persist($quizzCategory);
        $this->addReference('quizzcategory-informatique', $quizzCategory);

        $quizzCategory = (new QuizzCategory())
            ->setName('Le Web')
            ->setActive(true)
            ->setParent($this->getReference('quizzcategory-informatique'));
        $manager->persist($quizzCategory);
        $this->addReference('quizzcategory-le-web', $quizzCategory);

        $quizzCategory = (new QuizzCategory())
            ->setName('Développement Web')
            ->setCover('developpement-web657d8d0f54b2a.png')
            ->setActive(true)
            ->setParent($this->getReference('quizzcategory-informatique'));
        $manager->persist($quizzCategory);
        $this->addReference('quizzcategory-developpement-web', $quizzCategory);

        $quizzCategory = (new QuizzCategory())
            ->setName('Développement Front-End')
            ->setActive(true)
            ->setParent($this->getReference('quizzcategory-developpement-web'));
        $manager->persist($quizzCategory);
        $this->addReference('quizzcategory-front-end', $quizzCategory);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 3;
    }
}
