<?php

namespace App\Controller\Api;

use App\Entity\Log;
use App\Repository\LogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/api/log', name: 'api_log_')]
class LogController extends AbstractController
{
    #[Route('', name: 'browse', methods: ['GET'])]
    public function browse(LogRepository $LogRepository): Response
    {        
        return $this->json($LogRepository->findOneBy([], ['id' => 'DESC']), 200, []);
    }

    #[Route('/all', name: 'all', methods: ['GET'])]
    public function all(LogRepository $LogRepository): Response
    {        
        return $this->json($LogRepository->findBy([], ['createdAt' => 'DESC']));
    }
}