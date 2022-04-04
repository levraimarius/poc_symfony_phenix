<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Highlight;

class HighlightFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $highlight = new Highlight();
            $highlight->setName(sprintf('highlight name '.$i));
            $highlight->setDate(\DateTime::createFromFormat('Y-m-d',"2022-02-28"));
            $highlight->setMilestone($this->getReference('milestone'.$i));
            $highlight->setDescription(sprintf('highlight description '.$i));
            $highlight->setProject($this->getReference('project'.$i));

            $manager->persist($highlight);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            MilestoneFixtures::class,
            ProjectFixtures::class
        );
    }
}
