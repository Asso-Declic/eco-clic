<?php

namespace App\Controller\Api;

use App\Entity\Category;
use App\Repository\ScoreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/score', name: 'api_score_')]
class ScoreController extends AbstractController
{
    #[Route('/{id}', name: 'for_category')]
    public function forCategory(Category $category, ScoreRepository $scoreRepository): Response
    {
        $score = $scoreRepository->findScoreForCategory($category, $this->getUser()->getCollectivite());
        return $this->json(['data' => $score]);
    }
}
