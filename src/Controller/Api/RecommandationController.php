<?php

namespace App\Controller\Api;

use App\Entity\Category;
use App\Repository\RecommandationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/recommandation', name: 'api_recommandation_')]
class RecommandationController extends AbstractController
{
    /**
     * Fournit les recommandations par catégorie pour une collectivité
     *
     * @param RecommandationRepository $recommandationRepository
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/by-category/{id}', name: 'by_category', requirements: ['id' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$'])]
    public function byCategory(Category $category, RecommandationRepository $recommandationRepository, Request $request): JsonResponse
    {
        $recommandations = $recommandationRepository->findByCategory($category, $this->getUser()->getCollectivite());
        return $this->json(['data' => $recommandations]);
    }

    #[Route('/totals-per-categories', name: 'totals_per_categories')]
    public function totalsPerCategories(RecommandationRepository $recommandationRepository): JsonResponse
    {
        $totals = $recommandationRepository->findTotalsPerCategories($this->getUser()->getCollectivite());
        return $this->json(['data' => $totals]);
    }
}


