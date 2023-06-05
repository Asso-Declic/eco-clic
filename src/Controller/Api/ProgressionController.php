<?php

namespace App\Controller\Api;

use App\Entity\Category;
use App\Repository\CollectiviteAnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/progression', name: 'api_progression_')]
class ProgressionController extends AbstractController
{
    #[Route('', name: 'global')]
    public function global(CollectiviteAnswerRepository $collectiviteAnswerRepository): Response
    {
        $collectivite = $this->getUser()->getCollectivite();
        return $this->json($collectiviteAnswerRepository->findProgression($collectivite));
    }

    #[Route('/by-category/{id}', name: 'by_category', requirements: ['id' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$'])]
    public function byCategory(Category $category, CollectiviteAnswerRepository $collectiviteAnswerRepository): Response
    {
        $collectivite = $this->getUser()->getCollectivite();
        $data = $collectiviteAnswerRepository->findProgressionByCategory($category, $collectivite);
        return $this->json(["data" => $data]);
    }
}
