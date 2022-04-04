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

        $members = [];

        for($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail(sprintf('user-'.$i.'@yopmail.com'));
            $user->setFirstName(sprintf('user'.$i));
            $user->setLastName(sprintf('user'.$i));
            $user->setPassword($this->hasher->hashPassword($user, 'password'));
            // $user->setTeam($this->getReference('team'.$i));
            $this->setReference('user'.$i, $user);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
