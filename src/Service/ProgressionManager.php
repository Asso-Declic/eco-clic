<?php

namespace App\Service;

use App\Entity\Category;
use App\Entity\Collectivite;
use App\Repository\CollectiviteAnswerRepository;
use App\Repository\ScoreRepository;

class ProgressionManager
{
    public function __construct(
        private CollectiviteAnswerRepository $collectiviteAnswerRepository,
        private ScoreRepository $scoreRepository
    ) {}

    public function getCollectiviteProgression(Collectivite $collectivite)
    {
        return $this->collectiviteAnswerRepository->findCollectiviteProgression($collectivite);
    }
    
    public function getCollectiviteProgressionByCategory(Category $category, Collectivite $collectivite)
    {
        return $this->collectiviteAnswerRepository->findCollectiviteProgressionByCategory($category, $collectivite);
    }
    
    public function isProgressionComplete(Collectivite $collectivite)
    {

        // return $this->scoreRepository->isProgressionComplete($collectivite);
    }
}