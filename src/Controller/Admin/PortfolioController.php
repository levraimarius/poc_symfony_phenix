<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Response, Request};
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Portfolio;
use App\Repository\PortfolioRepository;
use App\Form\PortfolioEditType;

class PortfolioController extends AbstractController
{
    #[Route('/administration/portfolio', name: 'app_portfolio_administration')]
    public function portfolioAdministration(PortfolioRepository $portfolioRepository): Response
    {
        return $this->render('administration/portfolio/portfolio.html.twig', [
            'portfolios' => $portfolioRepository->findAll(),
        ]);
    }

    #[Route('/administration/portfolio/{id}/edit', name: 'app_portfolio_edit')]
    public function portfolioEdit(ManagerRegistry $doctrine, Portfolio $portfolio, Request $request): Response
    {
        $portfolioEditForm = $this->createForm(PortfolioEditType::class, $portfolio);
        $portfolioEditForm->handleRequest($request);

        if($portfolioEditForm->isSubmitted() && $portfolioEditForm->isValid()) {
            $em = $doctrine->getManager();
            $em->flush();

            return $this->redirectToRoute('app_portfolio_administration');
        }

        return $this->render('administration/portfolio/portfolioEdit.html.twig', [
          'portfolio' => $portfolio,
          'portfolioEditForm' => $portfolioEditForm->createView(),
        ]);
    }

    #[Route('/administration/portfolio/{id}/delete', name: 'app_portfolio_delete')]
    public function portfolioDelete(ManagerRegistry $doctrine, Portfolio $portfolio): Response
    {
        $em = $doctrine->getManager();
        $em->remove($portfolio);
        $em->flush();

        return $this->redirectToRoute("app_portfolio_administration");
    }
}
