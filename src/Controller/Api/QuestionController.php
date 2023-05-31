<?php

namespace App\Controller\Api;

use App\Entity\Answer;
use App\Entity\Category;
use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/question', name: 'api_question_')]
class QuestionController extends AbstractController
{
    #[Route('/by-category/{id}', name: 'by_category')]
    public function byCategory(Category $category, QuestionRepository $questionRepository): JsonResponse
    {
        $questions = $questionRepository->findByCategory($category);
        return $this->json(['data' => $questions]);
    }

    #[Route('/by-parent-answer/{id}', name: 'by_parent_answer')]
    public function byParentAnswer(Answer $answer, QuestionRepository $questionRepository): JsonResponse
    {
        $questions = $questionRepository->findByParentAnswer($answer);
        return $this->json(['data' => $questions]);
    }
}
