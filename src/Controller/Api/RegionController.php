<?php

namespace App\Controller\Api;

use App\Entity\Departement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/regions', name: 'api_region_')]
class RegionController extends AbstractController
{
    #[Route('/{departement}', name: 'department')]
    public function getByDepartment(Departement $departement): Response
    {
        return $this->json($departement->getRegion()->getId());
    }
}
