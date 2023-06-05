<?php

namespace App\Controller\Api;

use App\Entity\Category;
use App\Repository\RecommandationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/recommandation', name: 'api_recommandation_')]
class RecommandationController extends AbstractController
{
    #[Route('', name: 'browse', methods: ['GET'])]
    public function browse(RecommandationRepository $recommandationRepository): JsonResponse
    {
        $recommandations = $recommandationRepository->findAllForCollectivite($this->getUser()->getCollectivite());
        return $this->json($recommandations);
    }

    /**
     * Fournit les recommandations par catégorie pour une collectivité
     *
     * @param Category $category
     * @param RecommandationRepository $recommandationRepository
     * @return JsonResponse
     */
    #[Route('/by-category/{id}', name: 'by_category', requirements: ['id' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$'])]
    public function byCategory(Category $category, RecommandationRepository $recommandationRepository): JsonResponse
    {
        $recommandations = $recommandationRepository->findByCategory($category, $this->getUser()->getCollectivite());
        return $this->json($recommandations);
    }

    #[Route('/totals-per-categories', name: 'totals_per_categories')]
    public function totalsPerCategories(RecommandationRepository $recommandationRepository): JsonResponse
    {
        $totals = $recommandationRepository->findTotalsPerCategories($this->getUser()->getCollectivite());
        return $this->json(['data' => $totals]);
    }
    
    #[Route('/filters', name: 'filters')]
    public function filters(RecommandationRepository $recommandationRepository): JsonResponse
    {
        $filters = $recommandationRepository->findFilters($this->getUser()->getCollectivite());
        // return $this->json(['data' => $filters]);
        return $this->json(['data' => $filters]);
    }
}


