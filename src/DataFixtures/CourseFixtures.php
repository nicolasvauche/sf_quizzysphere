<?php

namespace App\DataFixtures;

use App\Entity\Course;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CourseFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $course = (new Course())
            ->setName('Full Stack Developer')
            ->setActive(true)
            ->addQuizzCategory($this->getReference('quizzcategory-le-web'))
            ->addQuizzCategory($this->getReference('quizzcategory-developpement-web'))
            ->addQuizzCategory($this->getReference('quizzcategory-front-end'))
            ->addUserGroup($this->getReference('usergroup-fsd-test'));
        $manager->persist($course);
        $this->addReference('course-fsd', $course);

        $course = (new Course())
            ->setName("Concepteur Développeur d'Applications")
            ->setActive(true)
            ->addQuizzCategory($this->getReference('quizzcategory-uml'))
            ->addQuizzCategory($this->getReference('quizzcategory-gestion-de-projets'))
            ->addQuizzCategory($this->getReference('quizzcategory-agile'))
            ->addUserGroup($this->getReference('usergroup-cda-test'));
        $manager->persist($course);
        $this->addReference('course-cda', $course);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 4;
    }
}
