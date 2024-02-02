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
            ->setName('Le Web')
            ->setActive(false);
        $manager->persist($quizzCategory);
        $this->addReference('quizzcategory-le-web', $quizzCategory);

        $quizzCategory = (new QuizzCategory())
            ->setName('Le Développement Web')
            ->setCover('developpement-web657d8d0f54b2a.png')
            ->setActive(true);
        $manager->persist($quizzCategory);
        $this->addReference('quizzcategory-developpement-web', $quizzCategory);

        $quizzCategory = (new QuizzCategory())
            ->setName('Le Développement Front-End')
            ->setCover('developpement-web657d8d0f54b2a.png')
            ->setActive(true)
            ->setParent($this->getReference('quizzcategory-developpement-web'));
        $manager->persist($quizzCategory);
        $this->addReference('quizzcategory-front-end', $quizzCategory);

        $quizzCategory = (new QuizzCategory())
            ->setName('Le langage JavaScript')
            ->setCover('javascript657d8d65971e2.png')
            ->setActive(true)
            ->setParent($this->getReference('quizzcategory-developpement-web'));
        $manager->persist($quizzCategory);
        $this->addReference('quizzcategory-js', $quizzCategory);

        $quizzCategory = (new QuizzCategory())
            ->setName('Le framework Symfony')
            ->setCover('symfony657d8d7ebc9ce.png')
            ->setActive(true)
            ->setParent($this->getReference('quizzcategory-developpement-web'));
        $manager->persist($quizzCategory);
        $this->addReference('quizzcategory-sf', $quizzCategory);

        $quizzCategory = (new QuizzCategory())
            ->setName("La Conception d'Applications")
            ->setCover('conception657d8c991cb4b.png')
            ->setActive(true);
        $manager->persist($quizzCategory);
        $this->addReference('quizzcategory-conception', $quizzCategory);

        $quizzCategory = (new QuizzCategory())
            ->setName("La Modélisation UML")
            ->setCover('uml657d8ca47eca2.png')
            ->setActive(true)
            ->setParent($this->getReference('quizzcategory-conception'));
        $manager->persist($quizzCategory);
        $this->addReference('quizzcategory-uml', $quizzCategory);

        $quizzCategory = (new QuizzCategory())
            ->setName("La Gestion de Projets")
            ->setCover('gestion-de-projets657d8c8b5830f.png')
            ->setActive(true);
        $manager->persist($quizzCategory);
        $this->addReference('quizzcategory-gestion-de-projets', $quizzCategory);

        $quizzCategory = (new QuizzCategory())
            ->setName("Les Méthodologies Agiles")
            ->setCover('agile657d8d30bae17.png')
            ->setActive(true)
            ->setParent($this->getReference('quizzcategory-gestion-de-projets'));
        $manager->persist($quizzCategory);
        $this->addReference('quizzcategory-agile', $quizzCategory);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 3;
    }
}
