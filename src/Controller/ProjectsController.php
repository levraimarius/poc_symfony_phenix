<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProjectRepository;
use App\Entity\Project;

class ProjectsController extends AbstractController
{
    #[Route('/projects', name: 'app_projects')]
    public function index(ProjectRepository $projectRepository): Response
    {
        return $this->render('projects/index.html.twig', [
            'projects' => $projectRepository->findAll(),
        ]);
    }

    #[Route('/projects/{id}', name: 'view_project')]
    public function view(Project $project): Response
    {
        return $this->render('projects/projectView.html.twig', [
            'project' => $project,
        ]);
    }
}
