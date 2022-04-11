<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Response, Request};
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Project;
use App\Repository\ProjectRepository;
use App\Form\ProjectEditType;

class ProjectController extends AbstractController
{
    #[Route('/administration/projects', name: 'app_projects_administration')]
    public function projectsAdministration(ProjectRepository $projectsRepository): Response
    {
        return $this->render('administration/project/projects.html.twig', [
            'projects' => $projectsRepository->findAll(),
        ]);
    }

    #[Route('/administration/projects/{id}/edit', name: 'app_project_edit')]
    public function projectEdit(ManagerRegistry $doctrine, Project $project, Request $request): Response
    {
        $projectEditForm = $this->createForm(ProjectEditType::class, $project);
        $projectEditForm->handleRequest($request);

        if($projectEditForm->isSubmitted() && $projectEditForm->isValid()) {
            $em = $doctrine->getManager();
            $em->flush();

            return $this->redirectToRoute('app_projects_administration');
        }

        return $this->render('administration/project/projectEdit.html.twig', [
          'project' => $project,
          'projectEditForm' => $projectEditForm->createView(),
        ]);
    }

    #[Route('/administration/projects/{id}/delete', name: 'app_project_delete')]
    public function projectDelete(ManagerRegistry $doctrine, Project $project): Response
    {
        $em = $doctrine->getManager();
        $em->remove($project);
        $em->flush();

        return $this->redirectToRoute("app_projects_administration");
    }
}
