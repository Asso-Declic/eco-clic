<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * Tableau de bord
     */
    #[Route('/', name: 'root_page')]
    public function accueil(): Response
    {
        return $this->render('main/accueil.html.twig');
    }

}