<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/statistiques', name: 'statistics_')]
class StatisticsController extends AbstractController
{
    #[Route('', name: 'main')]
    public function main(): Response
    {
        return $this->render('statistics/main.html.twig', [
            'controller_name' => 'StatisticsController',
        ]);
    }
}
