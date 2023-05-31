<?php

namespace App\Controller\Api;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/user-status', name: 'api_user_status_')]
class CollectiviteStatusController extends AbstractController
{
    #[Route('/{id}', name: 'update', methods: ['PUT'])]
    public function update(EntityManagerInterface $em): JsonResponse
    {
        $collectivite = $this->getUser()->getCollectivite();
        return $this->json();
    }
}
