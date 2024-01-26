<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements OrderedFixtureInterface
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->addUserGroup($this->getReference('usergroup-administrateurs'))
            ->setFirstname('Administrateur')
            ->setLastname('Système')
            ->setPseudo('admin')
            ->setEmail('admin@quizzysphere.com')
            ->setPassword($this->passwordHasher->hashPassword($user, 'admin'))
            ->setRoles(['ROLE_ADMIN'])
            ->setActive(true);
        $manager->persist($user);
        $this->addReference('user-admin', $user);

        $user = new User();
        $user->addUserGroup($this->getReference('usergroup-testeurs'))
            ->setGender('Monsieur')
            ->setFirstname('Nicolas')
            ->setLastname('Vauché')
            ->setPseudo('nicolasvauche')
            ->setEmail('nicolas@quizzysphere.com')
            ->setPassword($this->passwordHasher->hashPassword($user, 'nicolas'))
            ->setActive(true);
        $manager->persist($user);
        $this->addReference('user-nicolasvauche', $user);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 2;
    }
}
