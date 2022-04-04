<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProjectRepository;
use App\Repository\RiskRepository;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(ProjectRepository $projectRepository, RiskRepository $riskRepository): Response
    {
        $userIdTeam = $this->getUser()->getId();
        $projectId = $projectRepository->findBy(['team' => $userIdTeam]);

        return $this->render('dashboard/index.html.twig', [
            'myProjects' => $projectRepository->findBy(['team' => $userIdTeam]),
            'myTeamProjects' => $projectRepository->findBy(['team' => $userIdTeam]),
            'projectsWithRisks' => $riskRepository->findBy(['project' => $projectId]),
        ]);
    }
}
