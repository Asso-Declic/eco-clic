<?php

namespace App\Controller\Api;

use App\Entity\Category;
use App\Entity\CollectiviteAnswer;
use App\Entity\Question;
use App\Entity\Score;
use App\Repository\CollectiviteAnswerRepository;
use App\Repository\ScoreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/score', name: 'api_score_')]
class ScoreController extends AbstractController
{
    #[Route('', name: 'browse', methods: ['GET'])]
    public function browse(CollectiviteAnswerRepository $collectiviteAnswerRepository): Response
    {
        $collectivite = $this->getUser()->getCollectivite();
        return $this->json($collectiviteAnswerRepository->findScore($collectivite));
    }

    #[Route('/{id}', name: 'browse_for_category', methods: ['GET'], requirements: ['id' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$'])]
    public function browseForCategory(Category $category, ScoreRepository $scoreRepository): Response
    {
        $score = $scoreRepository->findScoreForCategory($category, $this->getUser()->getCollectivite());
        // MySQL, avec PHP, retourne un string pour une fonction SUM()
        // Il faut renvoyer un int pour être propre et Doctrine n'aide pas beaucoup pour CAST en INT
        // On utilise un pansement ici, mais il faudrait trouver une solution plus propre (soit on est sale en JS, soit on est sale en PHP, il fallait choisir)
        $score['score'] = (int) $score['score'];

        return $this->json($score, 200, [], ['groups' => 'score']);
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
