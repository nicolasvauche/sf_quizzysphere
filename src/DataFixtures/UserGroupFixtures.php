<?php

namespace App\DataFixtures;

use App\Entity\UserGroup;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserGroupFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $userGroup = (new UserGroup())
            ->setName('Administrateurs')
            ->setActive(true);
        $manager->persist($userGroup);
        $this->addReference('usergroup-administrateurs', $userGroup);

        $userGroup = (new UserGroup())
            ->setName('Testeurs')
            ->setActive(true);
        $manager->persist($userGroup);
        $this->addReference('usergroup-testeurs', $userGroup);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 1;
    }
}
