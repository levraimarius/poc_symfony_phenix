<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Response, Request};
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Risk;
use App\Repository\RiskRepository;
use App\Form\RiskEditType;

class RiskController extends AbstractController
{
    #[Route('/administration/risk', name: 'app_risk_administration')]
    public function riskAdministration(RiskRepository $riskRepository): Response
    {
        return $this->render('administration/risk/risk.html.twig', [
            'risks' => $riskRepository->findAll(),
        ]);
    }

    #[Route('/administration/risk/{id}/edit', name: 'app_risk_edit')]
    public function riskEdit(ManagerRegistry $doctrine, Risk $risk, Request $request): Response
    {
        $riskEditForm = $this->createForm(RiskEditType::class, $risk);
        $riskEditForm->handleRequest($request);

        if($riskEditForm->isSubmitted() && $riskEditForm->isValid()) {
            $em = $doctrine->getManager();
            $em->flush();

            return $this->redirectToRoute('app_risk_administration');
        }

        return $this->render('administration/risk/riskEdit.html.twig', [
          'risk' => $risk,
          'riskEditForm' => $riskEditForm->createView(),
        ]);
    }

    #[Route('/administration/risk/{id}/delete', name: 'app_risk_delete')]
    public function riskDelete(ManagerRegistry $doctrine, Risk $risk): Response
    {
        $em = $doctrine->getManager();
        $em->remove($risk);
        $em->flush();

        return $this->redirectToRoute("app_risk_administration");
    }
}
