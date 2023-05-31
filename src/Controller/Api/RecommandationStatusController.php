<?php

namespace App\Controller\Api;

use App\Repository\RecommandationStatusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/recommandation-status', name: 'api_recommandation_status_')]
class RecommandationStatusController extends AbstractController
{
    #[Route('', name: 'browse', methods: ['GET'])]
    public function index(RecommandationStatusRepository $recommandationStatusRepository): JsonResponse
    {
        /* Requête d'origine
        SELECT Id, Label FROM ref_StatutReco ORDER BY Label
        */
        return $this->json(['data' => $recommandationStatusRepository->findBy([], ['label' => 'ASC'])], 200, [], ['groups' => 'recommandation_status']);
    }
}
