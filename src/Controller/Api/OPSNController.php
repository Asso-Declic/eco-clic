<?php

namespace App\Controller\Api;

use App\Entity\OPSN;
use App\Repository\OPSNRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/opsns', name: 'api_opsn_')]
class OPSNController extends AbstractController
{
    #[Route('', name: 'browse', methods: ['GET'])]
    public function browse(OPSNRepository $opsnRepository): JsonResponse
    {
        $opsnRepository->findAll();
        return $this->json($opsnRepository->findAll(), 200, [], ['groups' => 'opsn_browse']);
    }

    #[Route('/{id}', name: 'read', methods: ['GET'])]
    public function read(OPSN $opsn): JsonResponse
    {
        return $this->json($opsn, 200, [], ['groups' => 'opsn_browse']);
    }

    #[Route('/update-active/{id}', name: 'read', methods: ['PATCH'])]
    public function updateActive(EntityManagerInterface $em, OPSN $opsn): JsonResponse
    {
        // Idéalement il faudrait plutôt que la route reçoive un booléen plutôt que de faire un toggle
        $opsn->setActive(!$opsn->isActive());
        $em->flush();
        
        return $this->json($opsn, 200, [], ['groups' => 'opsn_browse']);
    }
}
