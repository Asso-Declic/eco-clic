<?php

namespace App\Service;

use App\Entity\Category;
use App\Entity\Collectivite;
use App\Entity\OPSN;
use App\Entity\Score;
use App\Repository\AnswerRepository;
use App\Repository\CollectiviteAnswerRepository;
use App\Repository\QuestionRepository;
use App\Repository\ScoreRepository;
use Doctrine\ORM\EntityManagerInterface;

class ScoreManager
{
    public function __construct(
        private AnswerRepository $answerRepository,
        private CollectiviteAnswerRepository $collectiviteAnswerRepository,
        private EntityManagerInterface $em,
        private ProgressionManager $progressionManager,
        private QuestionRepository $questionRepository,
        private ScoreRepository $scoreRepository
    ) {}

    /**
     * Retourne la lettre correspondant à un score
     * 
     * @param int|null $score
     * @return string
     */
    public function assessLetter(?int $score): string
    {
        if ($score === null) {
            return 'N/A';
        } else if ($score >= 99) {
            return 'A';
        } else if ($score < 99 && $score >= 80) {
            return 'B';
        } else if ($score < 80 && $score >= 60) {
            return 'C';
        } else if ($score < 60 && $score >= 40) {
            return 'D';
        } else { // < 40
            return 'E';
        }
    }

    public function count(Collectivite $collectivite)
    {
        return $this->collectiviteAnswerRepository->countScore($collectivite);
    }

    public function countForCategory(Category $category, Collectivite $collectivite)
    {
        return $this->answerRepository->countScoreForCategory($category, $collectivite);
    }
    
    /**
     * Ajoute un score en base pour une collectivité et pour une catégorie si précisé
     * Retourne null si la progression n'est pas complète, retourne l'objet Score créé sinon
     *
     * @param Collectivite $collectivite
     * @return Score|null
     */
    public function createAndSave(Collectivite $collectivite, ?Category $category = null): ?Score
    {
        if (!$this->progressionManager->isProgressionComplete($collectivite, $category)) {
            return null;
        }

        if ($category !== null) {
            $currentScore = $this->countForCategory($category, $collectivite);
            $scoreNumber = floor($currentScore['score'] * 100 / $currentScore['nb']);
        } else {
            $currentScore = $this->count($collectivite);
            $scoreNumber = floor($currentScore['score'] * 100 / $currentScore['nb']);
        }
        
        $score = $this->setScore($collectivite, $scoreNumber, $category);

        return $score;
    }
    
    /**
     * Récupère le score actuel d'une collectivité,
     * ou le calcule s'il n'existe pas encore (par défaut)
     *
     * @param Collectivite $collectivite
     * @param boolean $force Pour forcer le calcul du score quand il est null, par défaut true.
     *                       Permet d'optimiser en évitant de calculer le score si ce n'est pas nécessaire
     * @return Score|array
     */
    public function getCurrent(Collectivite $collectivite, bool $force = true)
    {
        $score = $this->scoreRepository->findOneBy(['collectivite' => $collectivite, 'category' => null], ['scoredAt' => 'DESC']);
        if (!$score && $force) {
            $score = $this->count($collectivite);
        }
        return $score;
    }

    /**
     * Calcul de la lettre correspondant au score actuel d'une collectivité
     * La logique est ici côté back mais aussi ailleurs en front. Il faudrait centraliser.
     *
     * @param Collectivite $collectivite
     * @return string
     */
    public function getCurrentLetter(Collectivite $collectivite): string
    {
        $currentScore = $this->getCurrent($collectivite);
        if (is_array($currentScore)) {
            $score = $currentScore['score'];
        } else {
            $score = $currentScore->getScore();
        }
        if (!$score) {
            return 'N/A';
        }

        return $this->assessLetter($score);
    }

    public function getList(Collectivite $collectivite)
    {
        $scores = $this->scoreRepository->findBy(['collectivite' => $collectivite], ['scoredAt' => 'ASC']);
        return $scores;
    }

    /**
     * Récupère le score moyen d'une OPSN basé sur le dernier score de toutes les collectivités
     * 
     * @param OPSN $opsn
     * @return string|null
     */
    public function getOpsnAverage(OPSN $opsn): ?string
    {
        return $this->scoreRepository->findOpsnAverage($opsn);
    }

    /**
     * Enregistre un score en base pour une collectivité et pour une catégorie si précisé
     *
     * @param Collectivite $collectivite
     * @param integer $scoreNumber
     * @param Category|null $category
     * @return Score
     */
    public function setScore(Collectivite $collectivite, int $scoreNumber, ?Category $category = null): Score
    {
        $score = new Score();
        $score->setCollectivite($collectivite);
        $score->setScore($scoreNumber);
        $score->setScoredAt(new \DateTimeImmutable());
        $score->setCategory($category);
        
        $this->em->persist($score);
        $this->em->flush();

        return $score;
    }
}