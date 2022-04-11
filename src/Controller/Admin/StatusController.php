<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Response, Request};
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Status;
use App\Repository\StatusRepository;
use App\Form\StatusEditType;

class StatusController extends AbstractController
{
    #[Route('/administration/status', name: 'app_status_administration')]
    public function statusAdministration(StatusRepository $statusRepository): Response
    {
        return $this->render('administration/status/status.html.twig', [
            'status' => $statusRepository->findAll(),
        ]);
    }

    #[Route('/administration/status/{id}/edit', name: 'app_status_edit')]
    public function statusEdit(ManagerRegistry $doctrine, Status $status, Request $request): Response
    {
        $statusEditForm = $this->createForm(StatusEditType::class, $status);
        $statusEditForm->handleRequest($request);

        if($statusEditForm->isSubmitted() && $statusEditForm->isValid()) {
            $em = $doctrine->getManager();
            $em->flush();

            return $this->redirectToRoute('app_status_administration');
        }

        return $this->render('administration/status/statusEdit.html.twig', [
          'status' => $status,
          'statusEditForm' => $statusEditForm->createView(),
        ]);
    }

    #[Route('/administration/status/{id}/delete', name: 'app_status_delete')]
    public function statusDelete(ManagerRegistry $doctrine, Status $status): Response
    {
        $em = $doctrine->getManager();
        $em->remove($status);
        $em->flush();

        return $this->redirectToRoute("app_status_administration");
    }
}
