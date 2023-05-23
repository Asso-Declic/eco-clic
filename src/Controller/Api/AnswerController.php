<?php

namespace App\Controller\Api;

use App\Repository\AnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/answer', name: 'api_answer_')]
class AnswerController extends AbstractController
{
    #[Route('/ponderation-max', name: 'ponderation_max')]
    public function ponderationMax(AnswerRepository $answerRepository): JsonResponse
    {
        return $this->json(['data' => $answerRepository->findPonderationMax()]);
    }
}
