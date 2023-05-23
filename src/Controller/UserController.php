<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/utilisateur', name: 'user_')]
class UserController extends AbstractController
{
    #[Route('/inscription', name: 'registration')]
    public function registration(): Response
    {
        return $this->render('utilisateur/registration.html.twig');
    }

    #[Route('/profil', name: 'profile')]
    public function profile(): Response
    {
        return $this->render('utilisateur/profile.html.twig');
    }
}
