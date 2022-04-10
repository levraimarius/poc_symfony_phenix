<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher) { }

    public function load(ObjectManager $manager): void
    {
        $userAdmin = new User();
        $userAdmin->setEmail(sprintf('admin@yopmail.com'));
        $userAdmin->setFirstName(sprintf('admin'));
        $userAdmin->setLastName(sprintf('admin'));
        $userAdmin->setRoles(array('ROLE_ADMIN'));
        $userAdmin->setPassword($this->hasher->hashPassword($userAdmin, 'password'));
        $this->setReference('user', $userAdmin);
        $manager->persist($userAdmin);

        for($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail(sprintf('user-'.$i.'@yopmail.com'));
            $user->setFirstName(sprintf('user'.$i));
            $user->setLastName(sprintf('user'.$i));
            $user->setRoles(array('ROLE_USER'));
            $user->setPassword($this->hasher->hashPassword($user, 'password'));
            $this->setReference('user'.$i, $user);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
