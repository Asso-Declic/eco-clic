<?php

namespace App\Controller\Api;

use App\Repository\DepartementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/departments', name: 'api_department_')]
class DepartmentController extends AbstractController
{
    #[Route('', name: 'browse')]
    public function browse(DepartementRepository $departementRepository): JsonResponse
    {
        return $this->json($departementRepository->findAll(), 200, [], ['groups' => 'department_browse']);
    }
}
