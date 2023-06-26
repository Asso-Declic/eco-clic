<?php

namespace App\Controller\Api;

use App\Entity\Category;
use App\Service\ProgressionManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/progression', name: 'api_progression_')]
class ProgressionController extends AbstractController
{
    /**
     * Fournit un total de réponses pour chaque catégorie
     * Fournit un total de réponses unifié avec ?unified=true
     *
     * @param ProgressionManager $progressionManager
     * @param Request $request
     * @return Response
     */
    #[Route('', name: 'global')]
    public function global(ProgressionManager $progressionManager, Request $request): Response
    {
        $collectivite = $this->getUser()->getCollectivite();
        if ($request->query->getBoolean('unified')) {
            return $this->json($progressionManager->getGlobal($collectivite));
        }

        return $this->json($progressionManager->get($collectivite));
    }

    #[Route('/by-category/{id}', name: 'by_category', requirements: ['id' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$'])]
    public function byCategory(Category $category, ProgressionManager $progressionManager): Response
    {
        $collectivite = $this->getUser()->getCollectivite();
        $data = $progressionManager->getByCategory($category, $collectivite);
        return $this->json(["data" => $data]);
    }
}
