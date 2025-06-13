<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: 'admin_main_')]
class MainController extends AbstractController
{
    #[Route('', name: 'accueil')]
    public function accueil(): Response
    {
        return $this->redirectToRoute('admin_collectivite_browse');
    }
}
