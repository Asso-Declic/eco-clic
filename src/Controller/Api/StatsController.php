<?php

namespace App\Controller\Api;

use App\Service\StatsManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

#[Route('/api/stats', name: 'api_stats_')]
class StatsController extends AbstractController
{

    #[Route('', name: 'browse', methods: ['GET'])]
    public function browse(StatsManager $statsManager): Response
    {
        $collectivite = $this->getUser()->getCollectivite();
        $stats = $statsManager->getHistory($collectivite);

        // On sérialise selon le group «stats» mais on ignore la catégorie
        return $this->json($stats, 200, [], ['groups' => 'stats', AbstractNormalizer::IGNORED_ATTRIBUTES => ['category']]);
    }

    #[Route('/complete', name: 'browse_complete', methods: ['GET'])]
    public function complete(NormalizerInterface $normalizer, StatsManager $statsManager): Response
    {
        $collectivite = $this->getUser()->getCollectivite();
        
        // Collectivite
        $statsCollectivite = $statsManager->getHistory($collectivite);
        $stats = $normalizer->normalize($statsCollectivite, null, ['groups' => 'stats', AbstractNormalizer::IGNORED_ATTRIBUTES => ['category']]);

        // Departement by same population
        $statsDepartement = $statsManager->getScoreHistoryFor($collectivite, 'DepartementPopulation');
        $stats = $statsManager->mergeScores($stats, $statsDepartement);

        // Departement by same type
        $statsDepartement = $statsManager->getScoreHistoryFor($collectivite, 'DepartementType');
        $stats = $statsManager->mergeScores($stats, $statsDepartement);

        // Region by same population
        $statsRegion = $statsManager->getScoreHistoryFor($collectivite, 'RegionPopulation');
        $stats = $statsManager->mergeScores($stats, $statsRegion);

        // Region by same type
        $statsRegion = $statsManager->getScoreHistoryFor($collectivite, 'RegionType');
        $stats = $statsManager->mergeScores($stats, $statsRegion);

        // Nation
        $statsNation = $statsManager->getScoreHistoryFor($collectivite, 'Nation');
        $stats = $statsManager->mergeScores($stats, $statsNation);

        return $this->json($stats);
    }


    #[Route('/filters', name: 'get_filters', methods: ['GET'])]
    public function getFilters(StatsManager $statsManager): Response
    {
        $collectivite = $this->getUser()->getCollectivite();
        $filters = $statsManager->getFilters($collectivite);

        return $this->json($filters, 200, [], ['groups' => 'filters']);
    }
}
