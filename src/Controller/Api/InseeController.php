<?php

namespace App\Controller\Api;

use App\Service\InseeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/insee', name: 'api_insee_')]
class InseeController extends AbstractController
{
    #[Route('/siret/{siret}', name: 'siret', requirements: ['siret' => '\d+'])]
    public function siret(string $siret, InseeService $inseeService): Response
    {
        // TODO : Pour optimiser, il faudrait que le code postal soit en BDD au lieu d'aller le chercher systématiquement. Idéalement, le front demande les infos sur la collectivité en une seule fois. Si le code postal est indisponible, on pourrait le demander à l'INSEE. Actuellement, on sollicite une API à chaque chargement d'une page pour une information qui ne change jamais ou presque.
        return $this->json($inseeService->getInformationFomSiret($siret));
    }
}
