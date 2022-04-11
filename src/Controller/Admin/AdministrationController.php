<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Response, Request};
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\{User, Team, Status, Project, Risk, Portfolio, Milestone, Highlight};
use App\Repository\{UserRepository, TeamRepository, StatusRepository, ProjectRepository, RiskRepository, PortfolioRepository, MilestoneRepository, HighlightRepository};
use App\Form\{UserEditType, TeamEditType, StatusEditType, ProjectEditType, RiskEditType, PortfolioEditType, MilestoneEditType, HighlightEditType};

class AdministrationController extends AbstractController
{
    #[Route('/administration', name: 'app_administration')]
    public function administration(): Response
    {
        return $this->render('administration/index.html.twig');
    }
}
