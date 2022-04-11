<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Response, Request};
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Highlight;
use App\Repository\HighlightRepository;
use App\Form\HighlightEditType;

class HighlightController extends AbstractController
{
    #[Route('/administration/highlight', name: 'app_highlight_administration')]
    public function highlightAdministration(HighlightRepository $highlightRepository): Response
    {
        return $this->render('administration/highlight/highlight.html.twig', [
            'highlights' => $highlightRepository->findAll(),
        ]);
    }

    #[Route('/administration/highlight/{id}/edit', name: 'app_highlight_edit')]
    public function highlightEdit(ManagerRegistry $doctrine, Highlight $highlight, Request $request): Response
    {
        $highlightEditForm = $this->createForm(HighlightEditType::class, $highlight);
        $highlightEditForm->handleRequest($request);

        if($highlightEditForm->isSubmitted() && $highlightEditForm->isValid()) {
            $em = $doctrine->getManager();
            $em->flush();

            return $this->redirectToRoute('app_highlight_administration');
        }

        return $this->render('administration/highlight/highlightEdit.html.twig', [
          'highlight' => $highlight,
          'highlightEditForm' => $highlightEditForm->createView(),
        ]);
    }

    #[Route('/administration/highlight/{id}/delete', name: 'app_highlight_delete')]
    public function highlightDelete(ManagerRegistry $doctrine, Highlight $highlight): Response
    {
        $em = $doctrine->getManager();
        $em->remove($highlight);
        $em->flush();

        return $this->redirectToRoute("app_highlight_administration");
    }
}
