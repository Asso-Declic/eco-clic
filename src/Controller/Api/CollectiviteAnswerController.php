<?php

namespace App\Controller\Api;

use App\Entity\Collectivite;
use App\Entity\Question;
use App\Repository\CollectiviteAnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/collectivite-answer', name: 'api_collectivite_answer_')]
class CollectiviteAnswerController extends AbstractController
{
    #[Route('/score', name: 'score')]
    public function score(CollectiviteAnswerRepository $collectiviteAnswerRepository): Response
    {
        $collectivite = $this->getUser()->getCollectivite();
        return $this->json(['data' => $collectiviteAnswerRepository->findScore($collectivite)]);
    }

    #[Route('/by-question/{id}', name: 'by_question')]
    public function byQuestion(CollectiviteAnswerRepository $collectiviteAnswerRepository, Question $question): Response
    {
        $collectivite = $this->getUser()->getCollectivite();
        $collectiviteAnswers = $collectiviteAnswerRepository->findbyQuestion($collectivite, $question);
        return $this->json(['data' => $collectiviteAnswers], 200, [], ['groups' => 'collectiviteAnswer']);
    }
}
