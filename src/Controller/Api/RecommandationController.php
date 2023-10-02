<?php

namespace App\Controller\Api;

use App\Entity\Category;
use App\Entity\Collectivite;
use App\Entity\Question;
use App\Repository\CategoryRepository;
use App\Repository\RecommandationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/recommendations', name: 'api_recommandation_')]
class RecommandationController extends AbstractController
{
    #[Route('', name: 'browse', methods: ['GET'])]
    public function browse(RecommandationRepository $recommandationRepository): JsonResponse
    {
        $recommandations = $recommandationRepository->findAllForCollectivite($this->getUser()->getCollectivite());
        return $this->json($recommandations);
    }

    /**
     * Fournit les recommandations par catégorie pour une collectivité
     *
     * @param Category $category
     * @param RecommandationRepository $recommandationRepository
     * @return JsonResponse
     */
    #[Route('/by-category/{id}', name: 'by_category', requirements: ['id' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$'])]
    public function byCategory(Category $category, RecommandationRepository $recommandationRepository): JsonResponse
    {
        $recommandations = $recommandationRepository->findByCategory($category, $this->getUser()->getCollectivite());
        return $this->json($recommandations);
    }

    /**
     * Fournit les recommandations par catégorie pour une collectivité
     * Doit fournir la liste des catégories à chaque fois
     *
     * @return JsonResponse
     */
    #[Route('/by-collectivite/{id}', name: 'by_collectivite', requirements: ['id' => '^([0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}|404)$'])]
    public function byCollectivite(CategoryRepository $categoryRepository, Collectivite $collectivite, RecommandationRepository $recommandationRepository): JsonResponse
    {
        $recommandations = $recommandationRepository->countTotalsPerCategories($collectivite);
        $categories = $categoryRepository->findBy([], ['sortOrder' => 'ASC']);

        foreach ($categories as $category) {
            $found = false;
            foreach ($recommandations as $recommandation) {
                if ($recommandation['id'] === $category->getId()) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $recommandations[] = [
                    'id' => $category->getId(),
                    'nb_recommandation' => 0,
                ];
            }
        }

        return $this->json($recommandations);
    }

    #[Route('/perso/by-category/{id}', name: 'custom_inputs', requirements: ['id' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$'])]
    public function persoByCategory(Category $category, RecommandationRepository $recommandationRepository): JsonResponse
    {
        $questions = $recommandationRepository->findRecommandationsPersoByCategory($category);
        return $this->json($questions, 200, [], ['groups' => ['question', 'recommandation_perso']]);
    }
    
    #[Route('/answers/{question}/{collectivite}', name: 'answers_by_question', requirements: ['question' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$'])]
    public function answersByQuestion(Collectivite $collectivite, Question $question, RecommandationRepository $recommandationRepository): JsonResponse
    {
        $questions = $recommandationRepository->findAnswersByQuestion($question, $collectivite);
        return $this->json($questions, 200, [], ['groups' => ['question', 'recommandation_perso']]);
    }

    #[Route('/filters', name: 'filters')]
    public function filters(RecommandationRepository $recommandationRepository): JsonResponse
    {
        $filters = $recommandationRepository->findFilters($this->getUser()->getCollectivite());
        // return $this->json(['data' => $filters]);
        return $this->json(['data' => $filters]);
    }

    #[Route('/non-active', name: 'non_active', methods: ['GET'])]
    public function nonActive(RecommandationRepository $recommandationRepository): JsonResponse
    {
        $recommandations = $recommandationRepository->findNonActive($this->getUser()->getCollectivite());
        return $this->json($recommandations);
    }

    #[Route('/totals-per-categories', name: 'totals_per_categories')]
    public function totalsPerCategories(RecommandationRepository $recommandationRepository): JsonResponse
    {
        $totals = $recommandationRepository->countTotalsPerCategories($this->getUser()->getCollectivite());
        return $this->json(['data' => $totals]);
    }
}


