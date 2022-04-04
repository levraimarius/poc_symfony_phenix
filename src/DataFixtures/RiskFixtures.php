<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Risk;

class RiskFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $severity = [
            "high",
            "low",
            "medium"
        ];

        for ($i = 0; $i < 10; $i++) {
            $risk = new Risk();
            $risk->setName(sprintf('risk name '.$i));
            $risk->setIdentificationDate(\DateTime::createFromFormat('Y-m-d',"2022-02-28"));
            $risk->setResolutionDate(\DateTime::createFromFormat('Y-m-d',"2022-03-28"));
            $risk->setSeverity($severity[rand(0, 2)]);
            $risk->setProbability(80);
            $risk->setProject($this->getReference('project'.$i));

            $manager->persist($risk);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProjectFixtures::class,
        );
    }
}
