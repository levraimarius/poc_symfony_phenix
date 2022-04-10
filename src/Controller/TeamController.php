<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Team;

class TeamController extends AbstractController
{
    #[Route('/team/{id}', name: 'view_team')]
    public function team(Team $team): Response
    {
        return $this->render('team/teamView.html.twig', [
            'team' => $team,
        ]);
    }
}
