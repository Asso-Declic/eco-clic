<?php

namespace App\Controller\Api;

use App\Entity\Answer;
use App\Entity\Question;
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

    #[Route('/by-question/{id}', name: 'by_question')]
    public function byQuestion(AnswerRepository $answerRepository, Question $question): JsonResponse
    {
        $questions = $answerRepository->findBy(['question' => $question]);
        return $this->json(['data' => $questions], 200, [], ['groups' => 'answer']);
    }

    #[Route('/{id}', name: 'read', requirements: ['id' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$'])]
    public function read(Answer $answer)
    {
        return $this->json(['data' => $answer]);
    }
}
