<?php

namespace App\Service;

use App\Entity\Collectivite;
use App\Repository\CollectiviteAnswerRepository;
use App\Repository\QuestionRepository;

class ScoreManager
{
    public function __construct(
        private CollectiviteAnswerRepository $collectiviteAnswerRepository,
        private QuestionRepository $questionRepository
    ) {}

    public function getCollectiviteScore(Collectivite $collectivite)
    {
        $score = $this->collectiviteAnswerRepository->findCurrentScore($collectivite);
        
    }
}