<?php

namespace App\Controller\Api;

use App\Repository\RecommandationLevelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/recommendation-levels', name: 'api_recommandation_level_')]
class RecommandationLevelController extends AbstractController
{
    #[Route('', name: 'browse', methods: ['GET'])]
    public function browse(RecommandationLevelRepository $recommandationLevelRepository): JsonResponse
    {
        return $this->json($recommandationLevelRepository->findAll(), 200, [], ['groups' => 'recommandation_level']);
    }
}
