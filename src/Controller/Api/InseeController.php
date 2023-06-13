<?php

namespace App\Controller\Api;

use App\Service\InseeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// TODO : Voir pour supprimer cette route ou non
#[Route('/api/insee', name: 'api_insee_')]
class InseeController extends AbstractController
{
    #[Route('/siret/{siret}', name: 'siret', requirements: ['siret' => '\d{14}'])]
    public function siret(string $siret, InseeService $inseeService): Response
    {
        return $this->json($inseeService->getInformationFomSiret($siret));
    }
}
