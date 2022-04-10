<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Team;

class TeamFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $teamAdmin = new Team();
        $teamAdmin->setName(sprintf('team admin'));
        $teamAdmin->setLeader($this->getReference('user'));
        $teamAdmin->addMember($this->getReference('user'));
        $this->setReference('team', $teamAdmin);
        $manager->persist($teamAdmin);

        for($i = 0; $i < 10; $i++) {
            $team = new Team();
            $team->setName(sprintf('team name'.$i));
            $team->setLeader($this->getReference('user'.$i));
            $team->addMember($this->getReference('user'.$i));
            $this->setReference('team'.$i, $team);
            $manager->persist($team);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
