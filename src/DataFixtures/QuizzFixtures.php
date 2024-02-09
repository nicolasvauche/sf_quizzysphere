<?php

namespace App\DataFixtures;

use App\Entity\Quizz;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class QuizzFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $quizz = (new Quizz())
            ->setName("L'Histoire du Web")
            ->setLevel('1 - Débutant')
            ->setActive(false)
            ->addQuizzCategory($this->getReference('quizzcategory-le-web'));
        $manager->persist($quizz);
        $this->addReference('quizz-histoire-du-web', $quizz);

        $quizz = (new Quizz())
            ->setName("La Conception avec UML")
            ->setCover('uml657d8ca47eca2.png')
            ->setLevel('1 - Débutant')
            ->setActive(true)
            ->addQuizzCategory($this->getReference('quizzcategory-uml'));
        $manager->persist($quizz);
        $this->addReference('quizz-conception-uml', $quizz);

        $quizz = (new Quizz())
            ->setName("L'Agilité")
            ->setCover('agile657d8d30bae17.png')
            ->setLevel('1 - Débutant')
            ->setActive(true)
            ->addQuizzCategory($this->getReference('quizzcategory-gestion-de-projets'));
        $manager->persist($quizz);
        $this->addReference('quizz-agilite', $quizz);

        $quizz = (new Quizz())
            ->setName("La Méthode SCRUM")
            ->setCover('scrum657d8d4001103.png')
            ->setLevel('2 - Intermédiaire')
            ->setActive(true)
            ->addQuizzCategory($this->getReference('quizzcategory-agile'));
        $manager->persist($quizz);
        $this->addReference('quizz-scrum', $quizz);

        $quizz = (new Quizz())
            ->setName("Les Fondamentaux du Front-End")
            ->setCover('developpement-front-end657d8d0f54b2a.png')
            ->setLevel('1 - Débutant')
            ->setActive(true)
            ->addQuizzCategory($this->getReference('quizzcategory-front-end'));
        $manager->persist($quizz);
        $this->addReference('quizz-frontend', $quizz);

        $quizz = (new Quizz())
            ->setName("Les Fondamentaux de JavaScript")
            ->setCover('javascript657d8d65971e2.png')
            ->setLevel('1 - Débutant')
            ->setActive(true)
            ->addQuizzCategory($this->getReference('quizzcategory-js'));
        $manager->persist($quizz);
        $this->addReference('quizz-js-fondamentaux', $quizz);

        $quizz = (new Quizz())
            ->setName("Les Structures de données")
            ->setCover('javascript657d8d65971e2.png')
            ->setLevel('2 - Intermédiaire')
            ->setActive(true)
            ->addQuizzCategory($this->getReference('quizzcategory-js'));
        $manager->persist($quizz);
        $this->addReference('quizz-js-structures-donnees', $quizz);

        $quizz = (new Quizz())
            ->setName("L'Assignation par Décomposition")
            ->setCover('javascript657d8d65971e2.png')
            ->setLevel('2 - Intermédiaire')
            ->setActive(true)
            ->addQuizzCategory($this->getReference('quizzcategory-js'));
        $manager->persist($quizz);
        $this->addReference('quizz-js-decomposition', $quizz);

        $quizz = (new Quizz())
            ->setName("Les Fonctions Constructeurs")
            ->setCover('javascript657d8d65971e2.png')
            ->setLevel('3 - Avancé')
            ->setActive(true)
            ->addQuizzCategory($this->getReference('quizzcategory-js'));
        $manager->persist($quizz);
        $this->addReference('quizz-js-fonctions-constructeurs', $quizz);

        $quizz = (new Quizz())
            ->setName("Les Fondamentaux de Symfony")
            ->setCover('symfony657d8d7ebc9ce.png')
            ->setLevel('1 - Débutant')
            ->setActive(true)
            ->addQuizzCategory($this->getReference('quizzcategory-sf'));
        $manager->persist($quizz);
        $this->addReference('quizz-sf-fondamentaux', $quizz);

        $quizz = (new Quizz())
            ->setName("Symfony 7")
            ->setCover('symfony657d8d7ebc9ce.png')
            ->setLevel('3 - Avancé')
            ->setActive(true)
            ->addQuizzCategory($this->getReference('quizzcategory-sf'));
        $manager->persist($quizz);
        $this->addReference('quizz-sf-avance', $quizz);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 5;
    }
}
