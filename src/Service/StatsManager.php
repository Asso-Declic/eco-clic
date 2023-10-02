<?php

namespace App\Service;

use App\Entity\Collectivite;
use App\Entity\Population;
use App\Repository\CollectiviteRepository;
use App\Repository\PopulationRepository;
use App\Repository\ScoreRepository;

/**
 * Toutes les méthodes retournent un résultat pour une collectivité donnée
 */
class StatsManager
{
    public function __construct(
        private CollectiviteRepository $collectiviteRepository,
        private PopulationRepository $populationRepository,
        private ScoreRepository $scoreRepository,
    ) {}

    /**
     * Retourne le score global de la collectivité
     *
     * @param Collectivite $collectivite
     * @param 'Departement', 'Region', 'Nation' $scale
     * @return array
     */
    public function getScoreHistoryFor(Collectivite $collectivite, string $scale): array
    {
        $population = $this->getPopulation($collectivite);
        switch($scale){
            case 'DepartementPopulation':
                $collectiviteIds = $this->collectiviteRepository->findInDepartementByPopulation($collectivite);
                $fieldName = 'scorePopulation' . $collectivite->getDepartement()->getName();
                break;
            case 'DepartementType':
                $collectiviteIds = $this->collectiviteRepository->findInDepartementByType($collectivite);
                $fieldName = 'scoreType' . $collectivite->getDepartement()->getName();
                break;
            case 'RegionPopulation':
                $collectiviteIds = $this->collectiviteRepository->findInRegionByPopulation($collectivite);
                $fieldName = 'scorePopulation' . $collectivite->getDepartement()->getRegion()->getName();
                break;
            case 'RegionType':
                $collectiviteIds = $this->collectiviteRepository->findInRegionByType($collectivite);
                $fieldName = 'scoreType' . $collectivite->getDepartement()->getRegion()->getName();
                break;
            case 'Nation':
                $collectiviteIds = $this->collectiviteRepository->findInNation();
                $fieldName = 'scorePopulationFrance';
                break;
            default:
                throw new \Exception('Scale not found');
                break;
        }

        return $this->scoreRepository->findGroupAverage($collectiviteIds, $fieldName);
    }

    /**
     * Fournit les filtres de statistiques en fonction de la collectivité
     * 
     * @parem Collectivite $collectivite
     * @return array
     */
    public function getFilters(Collectivite $collectivite)
    {
        return [
            'collectivite' => $collectivite,
            'departement' => $collectivite->getDepartement(),
            'region' => $collectivite->getDepartement()->getRegion(),
            'nation' => ['name' => 'France'],
        ];
    }

    /**
     * Retourne l'historique de score global pour la collectivité
     *
     * @param Collectivite $collectivite
     * @return array
     */
    public function getHistory(Collectivite $collectivite)
    {
        return $this->scoreRepository->findHistory($collectivite);
    }

    public function getHistoryDepartement(Collectivite $collectivite)
    {
        return $this->scoreRepository->findBy(['collectivite' => ['404', 'b7f6d2ad-9b9e-4f45-b151-56a0494a2e3a'], 'category' => null], ['scoredAt' => 'ASC']);
    }

    /**
     * Find Population
     *
     * @param Collectivite $collectivite
     * @return Population
     */
    public function getPopulation(Collectivite $collectivite): ?Population
    {
        return $this->populationRepository->findForCollectivite($collectivite);
    }

    /**
     * Merge two sets of scores
     * Looks for common dates to merge scores of different scales
     * 
     * @param array $score1
     * @param array $score2
     * @return array
     */
    public function mergeScores(array $score1, array $score2): array
    {
        $merged = [];
        foreach($score1 as $score) {
            $merged[$score['scoredAt']] = $score;
        }
        foreach($score2 as $score) {
            if (isset($merged[$score['scoredAt']])) {
                $merged[$score['scoredAt']] = array_merge($merged[$score['scoredAt']], $score);
            } else {
                $merged[$score['scoredAt']] = $score;
            }
        }
        return array_values($merged);
    }
}