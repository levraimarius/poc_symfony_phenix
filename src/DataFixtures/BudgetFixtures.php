<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Budget;

class BudgetFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $budget = new Budget();
            $budget->setInitialValue(10000);
            $budget->setConsumedValue(0);
            $budget->setRemaining(10000);
            $budget->setLanding(10000);
            $this->addReference('budget'.$i, $budget);

            $manager->persist($budget);
        }

        $manager->flush();
    }
}
