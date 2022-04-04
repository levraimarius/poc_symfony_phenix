<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Repository\TeamRepository;
use App\Entity\User;
use App\Entity\Team;
use App\Form\UserEditType;
use App\Form\TeamEditType;

class AdministrationController extends AbstractController
{
    #[Route('/administration', name: 'app_administration')]
    public function administration(): Response
    {
        return $this->render('administration/index.html.twig');
    }

    // Users administration

    #[Route('/administration/users', name: 'app_users_administration')]
    public function usersAdministration(UserRepository $usersRepository): Response
    {
        return $this->render('administration/users.html.twig', [
            'users' => $usersRepository->findAll(),
        ]);
    }

    #[Route('/administration/users/{id}/edit', name: 'app_user_edit')]
    public function userEdit(ManagerRegistry $doctrine, User $user, Request $request): Response
    {
        $userEditForm = $this->createForm(UserEditType::class, $user);
        $userEditForm->handleRequest($request);

        if($userEditForm->isSubmitted() && $userEditForm->isValid()) {
            $em = $doctrine->getManager();
            $em->flush();

            return $this->redirectToRoute('app_users_administration');
        }

        return $this->render('administration/userEdit.html.twig', [
          'user' => $user,
          'userEditForm' => $userEditForm->createView(),
        ]);
    }

    #[Route('/administration/users/{id}/delete', name: 'app_user_delete')]
    public function userDelete(ManagerRegistry $doctrine, User $user): Response
    {
        $em = $doctrine->getManager();
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute("app_users_administration");
    }

    // Teams administration

    #[Route('/administration/teams', name: 'app_teams_administration')]
    public function teamsAdministration(TeamRepository $teamsRepository): Response
    {
        return $this->render('administration/teams.html.twig', [
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

        return $this->render('administration/teamEdit.html.twig', [
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
