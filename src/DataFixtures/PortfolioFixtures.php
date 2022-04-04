<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Portfolio;

class PortfolioFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $portfolio = new Portfolio();
            $portfolio->setName(sprintf('portfolio name '.$i));
            $portfolio->setSupervisor($this->getReference('user'.$i));
            $this->addReference('portfolio'.$i, $portfolio);

            $manager->persist($portfolio);
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
