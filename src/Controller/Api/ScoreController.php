<?php

namespace App\Controller\Api;

use App\Entity\Category;
use App\Entity\CollectiviteAnswer;
use App\Entity\Question;
use App\Entity\Score;
use App\Repository\ScoreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/score', name: 'api_score_')]
class ScoreController extends AbstractController
{
    #[Route('/{id}', name: 'browse_for_category', methods: ['GET'])]
    public function browseForCategory(Category $category, ScoreRepository $scoreRepository): Response
    {
        $score = $scoreRepository->findScoreForCategory($category, $this->getUser()->getCollectivite());
        return $this->json(['data' => $score]);
    }

    #[Route('', name: 'add', methods: ['POST'])]
    public function add(EntityManagerInterface $em): Response
    {
        $collectivite = $this->getUser()->getCollectivite();
        $totalQuestions = $em->getRepository(Question::class)->countAllQuestions();
        $currentScore = $em->getRepository(CollectiviteAnswer::class)->findCurrentScore($collectivite);
        $score = new Score();
        // TODO : Pourquoi cette vérification ?
        if ($totalQuestions == $currentScore['nb']) {
            $newScore = floor($currentScore['score'] * 100 / $currentScore['nb']);
            
            $score->setCollectivite($collectivite);
            $score->setScore($newScore);
            $score->setScoredAt(new \DateTimeImmutable());
            $em->persist($score);
            $em->flush();
        }

        return $this->json(['data' => $score], 201, [], ['groups' => 'score']);
    }
}
