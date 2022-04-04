<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Milestone;

class MilestoneFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $bool = [
            true,
            false,
        ];

        for ($i = 0; $i < 10; $i++) {
            $milestone = new Milestone();
            $milestone->setName(sprintf('milestone name '.$i));
            $milestone->setValue($i);
            $milestone->setIsMandatory($bool[rand(0, 1)]);
            $this->addReference('milestone'.$i, $milestone);

            $manager->persist($milestone);
        }

        $manager->flush();
    }
}
