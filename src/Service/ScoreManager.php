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
     * ou le calcule s'il n'existe pas encore
     *
     * @param Collectivite $collectivite
     * @return void
     */
    public function getCurrent(Collectivite $collectivite)
    {
        $score = $this->scoreRepository->findOneBy(['collectivite' => $collectivite]);
        if (!$score) {
            $score = $this->count($collectivite);
        }

        return $score;
    }

    public function getForOpsn(OPSN $opsn)
    {
        return $this->scoreRepository->findByCollectiviteForOpsn($opsn);
    }
}