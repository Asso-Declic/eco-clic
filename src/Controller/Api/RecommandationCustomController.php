<?php

namespace App\Controller\Api;

use App\Entity\Category;
use App\Entity\Collectivite;
use App\Repository\RecommandationCustomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/recommandation-customs', name: 'api_recommandation_custom_')]
class RecommandationCustomController extends AbstractController
{
    #[Route('/by-category/{category}/{collectivite}', name: 'by_category')]
    public function byCategory(Category $category, Collectivite $collectivite, RecommandationCustomRepository $recommandationCustomRepository): JsonResponse
    {
        $recommandationCustoms = $recommandationCustomRepository->findByCategoryWithQuestions($category, $collectivite);
        return $this->json($recommandationCustoms, 200, [], ['groups' => 'recommandation_custom']);
    }
}
