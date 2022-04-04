<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Status;

class StatusFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $status = new Status();
            $status->setName(sprintf('status name '.$i));
            $status->setSlug(sprintf('slug'.$i));
            $status->setValue($i);
            $status->setColor(sprintf('#%06X', mt_rand(0, 0xFFFFFF)));
            $this->addReference('status'.$i, $status);

            $manager->persist($status);
        }

        $manager->flush();
    }
}
