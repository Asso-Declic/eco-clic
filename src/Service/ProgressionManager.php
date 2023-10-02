<?php

namespace App\Service;

use App\Entity\Category;
use App\Entity\Collectivite;
use App\Repository\CategoryRepository;
use App\Repository\CollectiviteAnswerRepository;
use App\Repository\QuestionRepository;
use App\Repository\ScoreRepository;

class ProgressionManager
{
    public function __construct(
        private CategoryRepository $categoryRepository,
        private CollectiviteAnswerRepository $collectiviteAnswerRepository,
        private QuestionRepository $questionRepository,
        private ScoreRepository $scoreRepository
    ) {}

    /**
     * Fournit le nombre de réponses par catégorie pour une collectivité.
     * Ne fournit pas le total de questions
     *
     * @param Collectivite $collectivite
     * @return array
     */
    public function get(Collectivite $collectivite)
    {
        // Gives totals but the category is not there if there is no answer
        // We need the category to be in the result and have 0 when there is no answer
        $totals = $this->collectiviteAnswerRepository->countAllByCategory($collectivite);
        $categories = $this->categoryRepository->findBy([], ['sortOrder' => 'ASC']);
        foreach ($categories as $category) {
            $found = false;
            foreach ($totals as $total) {
                if ($total['category_id'] === $category->getId()) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $totals[] = [
                    'category_id' => $category->getId(),
                    'category_image' => $category->getImage(),
                    'category_level_two' => $category->isLevelTwo(),
                    'category_name' => $category->getName(),
                    'nb_repondu' => 0
                ];
            }
        }

        return $totals;
    }

    public function getGlobal(Collectivite $collectivite)
    {
        $answersByCategory = $this->collectiviteAnswerRepository->countAllByCategory($collectivite);
        $totalQuestions = $this->questionRepository->countAllQuestions($collectivite);

        $totalAnswers = 0;
        foreach ($answersByCategory as $answer) {
            $totalAnswers += $answer['nb_repondu'];
        }

        return [
            'totalAnswers' => $totalAnswers,
            'totalQuestions' => $totalQuestions,
        ];
    }

    public function getGlobalPercentage(Collectivite $collectivite)
    {
        $progression = $this->getGlobal($collectivite);
        return floor($progression['totalAnswers'] * 100 / $progression['totalQuestions']);
    }
    
    /**
     * Fournit le nombre de réponses d'une catégorie pour une collectivité.
     * Ne fournit pas le total de questions
     *
     * @param Category $category
     * @param Collectivite $collectivite
     * @return array
     */
    public function getByCategory(Category $category, Collectivite $collectivite)
    {
        return $this->collectiviteAnswerRepository->countForOneCategory($category, $collectivite);
    }
    
    /**
     * Retourne true si toutes les questions ont été répondues par une collectivité, pour une catégorie si précisé.
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
    public function isProgressionComplete(Collectivite $collectivite, ?Category $category = null): bool
    {
        if ($category === null) {
            $progression = $this->getGlobal($collectivite);
        } else {
            $progression = [];
            $progression['totalAnswers'] = $this->getByCategory($category, $collectivite)[0]['nb_repondu'];
            $progression['totalQuestions'] = $this->questionRepository->countAllQuestions($collectivite, $category);
        }

        return $progression['totalAnswers'] === $progression['totalQuestions'];
    }
}