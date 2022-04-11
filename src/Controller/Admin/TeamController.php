<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Response, Request};
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Team;
use App\Repository\TeamRepository;
use App\Form\TeamEditType;

class TeamController extends AbstractController
{
    #[Route('/administration/teams', name: 'app_teams_administration')]
    public function teamsAdministration(TeamRepository $teamsRepository): Response
    {
        return $this->render('administration/team/teams.html.twig', [
            'teams' => $teamsRepository->findAll(),
        ]);
    }

    #[Route('/administration/teams/{id}/edit', name: 'app_team_edit')]
    public function teamsEdit(ManagerRegistry $doctrine, Team $team, Request $request): Response
    {
        $teamEditForm = $this->createForm(TeamEditType::class, $team);
        $teamEditForm->handleRequest($request);

        if($teamEditForm->isSubmitted() && $teamEditForm->isValid()) {
            $em = $doctrine->getManager();
            $em->flush();

            return $this->redirectToRoute('app_teams_administration');
        }

        return $this->render('administration/team/teamEdit.html.twig', [
          'team' => $team,
          'teamEditForm' => $teamEditForm->createView(),
        ]);
    }

    #[Route('/administration/teams/{id}/delete', name: 'app_team_delete')]
    public function teamsDelete(ManagerRegistry $doctrine, Team $team): Response
    {
        $em = $doctrine->getManager();
        $em->remove($team);
        $em->flush();

        return $this->redirectToRoute("app_teams_administration");
    }
}
