<?php

namespace App\Controller\Api;

use App\Entity\Recommandation;
use App\Repository\CollectiviteStatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/user-status', name: 'api_user_status_')]
class CollectiviteStatusController extends AbstractController
{
    #[Route('/{id}/{status}', name: 'update', methods: ['PUT'])]
    public function update(CollectiviteStatusRepository $collectiviteStatusRepository, EntityManagerInterface $em, Recommandation $recommandation, string $status): JsonResponse
    {
        $collectivite = $this->getUser()->getCollectivite();

        $collectiviteStatusRepository->updateCode($collectivite, $recommandation, $status);
        return $this->json();
    }
}
