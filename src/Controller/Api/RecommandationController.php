<?php

namespace App\Controller\Api;

use App\Repository\RecommandationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/recommandation', name: 'api_recommandation_')]
class RecommandationController extends AbstractController
{
    // #[Route('/statut', name: 'statut')]
    // public function statut(): JsonResponse
    // {
    //     return $this->json();
    // }

    #[Route('/totals-per-categories', name: 'totals_per_categories')]
    public function totalsPerCategories(RecommandationRepository $recommandationRepository): JsonResponse
    {
        $totals = $recommandationRepository->findTotalsPerCategories($this->getUser()->getCollectivite());
        return $this->json(['data' => $totals]);
    }
}
