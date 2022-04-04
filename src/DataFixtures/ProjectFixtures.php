<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Project;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $isArchived = [
            true,
            false
        ];

        $description = "Lorem ipsum dolor sit amet. Qui earum accusantium aut architecto saepe ut galisum voluptatem est tempora dolorem nam repudiandae quibusdam eum reprehenderit consequuntur. Rem sint omnis qui quam aliquid qui quisquam facere eum incidunt quas. Ex dolorem voluptas 33 aspernatur eius ea dolore officiis cum voluptas aspernatur quo sunt minima ut porro recusandae! Qui ullam doloribus non obcaecati ipsam ut voluptas Quis ut voluptatibus provident et iure assumenda vel expedita molestiae aut nesciunt voluptates!";

        for ($i = 0; $i < 10; $i++) {
            $project = new Project();
            $project->setName(sprintf('project name '.$i));
            $project->setDescription(sprintf($description));
            $project->setCode(rand(1, 300));
            $project->setTeam($this->getReference('team'.$i));
            $project->setClientTeam($this->getReference('team'.$i));
            $project->setStatus($this->getReference('status'.$i));
            $project->setStartedAt(\DateTimeImmutable::createFromFormat('Y-m-d',"2022-02-28"));
            $project->setEndedAt(\DateTimeImmutable::createFromFormat('Y-m-d',"2022-03-28"));
            $project->setBudget($this->getReference('budget'.$i));
            $project->setIsArchived($isArchived[rand(0,1)]);
            $project->setPortfolio($this->getReference('portfolio'.$i));
            $this->addReference('project'.$i, $project);

            $manager->persist($project);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            TeamFixtures::class,
            StatusFixtures::class,
            BudgetFixtures::class,
            PortfolioFixtures::class
        );
    }
}
