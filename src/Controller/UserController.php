<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/utilisateur', name: 'utilisateur_')]
class UserController extends AbstractController
{
    // TODO : ASAP
    #[Route('/inscription', name: 'inscription')]
    public function inscription(): Response
    {
        return $this->render('utilisateur/inscription.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

    #[Route('/profil', name: 'profil')]
    public function profil(): Response
    {
        return $this->render('utilisateur/profil.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

    // TODO : ASAP
    #[Route('/profil/update', name: 'update_profil', methods: ['POST'])]
    public function updateProfil(): Response
    {
        return $this->render('utilisateur/profil.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }
}
