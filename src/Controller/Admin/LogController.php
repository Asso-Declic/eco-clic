<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Log;
use App\Repository\LogRepository;

#[Route('/admin/log', name: 'admin_log_')]
class LogController extends AbstractController
{
    #[Route('/', name: 'browse', methods: ['GET'])]
    public function browse(LogRepository $logRepository): Response
    {
        return $this->render('admin/log/browse.html.twig', [
            'logs' => $logRepository->findAll(),
        ]);
    }
}