<?php

namespace App\Controller\Api;

use App\Entity\Answer;
use App\Entity\Category;
use App\Entity\Collectivite;
use App\Entity\Question;
use App\Repository\CollectiviteAnswerRepository;
use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/questions', name: 'api_question_')]
class QuestionController extends AbstractController
{
    #[Route('/by-category/{id}', name: 'by_category', requirements: ['id' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$'])]
    public function byCategory(Category $category, QuestionRepository $questionRepository): JsonResponse
    {
        $collectivite = $this->getUser()->getCollectivite();
        $questions = $questionRepository->findByCategory($category, $collectivite->isLevelTwo());
        return $this->json(['data' => $questions]);
    }

    #[Route('/count-left/by-category/{category}/{collectivite}', name: 'by_category_count_left', requirements: ['category' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$'])]
    public function byCategoryCountLeft(Category $category, Collectivite $collectivite, CollectiviteAnswerRepository $collectiviteAnswerRepository, QuestionRepository $questionRepository): JsonResponse
    {
        $nbQuestions = $questionRepository->countForOneCategory($category, $collectivite);
        // $questionsAnswered = $collectiviteAnswerRepository->countForOneCategory($category, $collectivite);
        // if (empty($questionsAnswered)) {
        //     $questionsAnswered['nb_repondu'] = 0;
        // } else {
        //     $questionsAnswered = $questionsAnswered[0];
        // }

        // // TODO : Revoir le calcul, on arrive à un résultat négatif
        // $total = $nbQuestions - $questionsAnswered['nb_repondu'];
        // if ($total < 0) {
        //     $total = 0;
        // }

        return $this->json(['data' => $nbQuestions]);
    }

    #[Route('/by-parent-answer/{id}', name: 'by_parent_answer', requirements: ['id' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$'])]
    public function byParentAnswer(Answer $answer, QuestionRepository $questionRepository): JsonResponse
    {
        $questions = $questionRepository->findByParentAnswer($answer);
        return $this->json(['data' => $questions], 200, [], ['groups' => 'question']);
    }


    #[Route('/by-parent-answer2/{answer}/{question}/{category}', name: 'by_parent_answer2', requirements: ['answer' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$', 'question' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$', 'category' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$'])]
    public function byParentAnswer2(Answer $answer, Question $question, Category $category, QuestionRepository $questionRepository): JsonResponse
    {
        $questions = $questionRepository->findByParentAnswer2($answer, $question, $category);
        return $this->json(['data' => $questions], 200, [], ['groups' => 'question']);
    }
}
