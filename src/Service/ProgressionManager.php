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
     * L'objectif de cette fonction est d'être le seul endroit du projet qui calcule
     * si une progression est complète ou non.
     * ⚠ Le calcul compare le nombre total de questions avec le nombre de réponses d'une collectivité
     * Cependant, si un cas survenait où une question n'est pas posée à une collectivité, le calcul
     * ne serait pas correct. Il faudra alors modifier la requête du nombre total de questions, pour
     * ne prendre en compte que les questions concernant cette collectivité.
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