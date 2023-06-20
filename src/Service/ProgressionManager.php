<?php

namespace App\Service;

use App\Entity\Category;
use App\Entity\Collectivite;
use App\Repository\CollectiviteAnswerRepository;
use App\Repository\QuestionRepository;
use App\Repository\ScoreRepository;

class ProgressionManager
{
    public function __construct(
        private CollectiviteAnswerRepository $collectiviteAnswerRepository,
        private QuestionRepository $questionRepository,
        private ScoreRepository $scoreRepository
    ) {}

    public function getCollectiviteProgression(Collectivite $collectivite)
    {
        return $this->collectiviteAnswerRepository->countAllByCategory($collectivite);
    }
    
    public function getCollectiviteProgressionByCategory(Category $category, Collectivite $collectivite)
    {
        return $this->collectiviteAnswerRepository->countForOneCategory($category, $collectivite);
    }
    
    /**
     * Retourne true si toutes les questions ont été répondues par une collectivité
     * 
     * @param Collectivite $collectivite
     * @return bool
     */
    public function isProgressionComplete(Collectivite $collectivite): bool
    {
        $answersByCategory = $this->collectiviteAnswerRepository->countAllByCategory($collectivite);
        $questions = $this->questionRepository->countAllQuestions();

        $totalAnswers = 0;
        foreach ($answersByCategory as $answer) {
            $totalAnswers += $answer['nb_repondu'];
        }

        return $totalAnswers === $questions;
    }
}