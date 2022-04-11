<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Response, Request};
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\UserEditType;

class UserController extends AbstractController
{
    #[Route('/administration/users', name: 'app_users_administration')]
    public function usersAdministration(UserRepository $usersRepository): Response
    {
        return $this->render('administration/user/users.html.twig', [
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

        return $this->render('administration/user/userEdit.html.twig', [
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
}
