<?php

namespace App\Controller;

use App\Entity\Recommandation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/recommandation', name: 'recommandation_')]
class RecommandationController extends AbstractController
{
    #[Route('', name: 'browse', methods: ['GET'])]
    public function browse(): Response
    {
        return $this->render('recommandation/browse.html.twig');
    }

    #[Route('/{id}', name: 'read', methods: ['GET'], requirements: ['id' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$'])]
    public function read(Recommandation $recommandation): Response
    {
        return $this->render('recommandation/read.html.twig', [
            'recommandation' => $recommandation,
        ]);
    }
}
