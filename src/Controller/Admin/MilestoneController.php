<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Response, Request};
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Milestone;
use App\Repository\MilestoneRepository;
use App\Form\MilestoneEditType;

class MilestoneController extends AbstractController
{
    #[Route('/administration/milestone', name: 'app_milestone_administration')]
    public function milestoneAdministration(MilestoneRepository $milestoneRepository): Response
    {
        return $this->render('administration/milestone/milestone.html.twig', [
            'milestones' => $milestoneRepository->findAll(),
        ]);
    }

    #[Route('/administration/milestone/{id}/edit', name: 'app_milestone_edit')]
    public function milestoneEdit(ManagerRegistry $doctrine, Milestone $milestone, Request $request): Response
    {
        $milestoneEditForm = $this->createForm(MilestoneEditType::class, $milestone);
        $milestoneEditForm->handleRequest($request);

        if($milestoneEditForm->isSubmitted() && $milestoneEditForm->isValid()) {
            $em = $doctrine->getManager();
            $em->flush();

            return $this->redirectToRoute('app_milestone_administration');
        }

        return $this->render('administration/milestone/milestoneEdit.html.twig', [
          'milestone' => $milestone,
          'milestoneEditForm' => $milestoneEditForm->createView(),
        ]);
    }

    #[Route('/administration/milestone/{id}/delete', name: 'app_milestone_delete')]
    public function milestoneDelete(ManagerRegistry $doctrine, Milestone $milestone): Response
    {
        $em = $doctrine->getManager();
        $em->remove($milestone);
        $em->flush();

        return $this->redirectToRoute("app_milestone_administration");
    }
}
