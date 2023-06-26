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

    public function count(Collectivite $collectivite)
    {
        return $this->collectiviteAnswerRepository->countScore($collectivite);
    }

    public function countForCategory(Category $category, Collectivite $collectivite)
    {
        return $this->answerRepository->countScoreForCategory($category, $collectivite);
    }
    
    /**
     * Ajoute un score en base pour une collectivité
     * Retourne null si la progression n'est pas complète, retourne l'objet Score créé sinon
     *
     * @param Collectivite $collectivite
     * @return Score|null
     */
    public function createAndSave(Collectivite $collectivite): ?Score
    {
        if (!$this->progressionManager->isProgressionComplete($collectivite)) {
            return null;
        }
        
        $currentScore = $this->count($collectivite);
        $scoreNumber = floor($currentScore['score'] * 100 / $currentScore['nb']);
    
        $score = new Score();
        $score->setCollectivite($collectivite);
        $score->setScore($scoreNumber);
        $score->setScoredAt(new \DateTimeImmutable());
        $this->em->persist($score);
        $this->em->flush();

        return $score;
    }
    
    /**
     * Récupère le score actuel d'une collectivité,
     * ou le calcule s'il n'existe pas encore (par défaut)
     *
     * @param Collectivite $collectivite
     * @param boolean $force pour forcer le calcul du score quand il est null, par défaut true
     * @return Score
     */
    public function getCurrent(Collectivite $collectivite, bool $force = true): Score
    {
        $score = $this->scoreRepository->findOneBy(['collectivite' => $collectivite], ['scoredAt' => 'DESC']);
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
        $score = $this->getCurrent($collectivite)->getScore();
        if (!$score) {
            return 'N/A';
        }

        if ($score >= 99) {
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

    public function getList(Collectivite $collectivite)
    {
        $scores = $this->scoreRepository->findBy(['collectivite' => $collectivite], ['scoredAt' => 'ASC']);
        return $scores;
    }

    /**
     * Récupère le score moyen d'une OPSN basé sur le dernier score de toutes les collectivités
     * 
     * @param OPSN $opsn
     * @return string
     */
    public function getOpsnAverage(OPSN $opsn): string
    {
        return $this->scoreRepository->findOpsnAverage($opsn);
    }
}