<?php

namespace App\Controller\Api;

use App\Entity\Answer;
use App\Entity\Collectivite;
use App\Entity\CollectiviteAnswer;
use App\Entity\Question;
use App\Repository\CollectiviteAnswerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/collectivite-answer', name: 'api_collectivite_answer_')]
class CollectiviteAnswerController extends AbstractController
{
    #[Route('/by-question/{id}', name: 'get_by_question', methods: ['GET'], requirements: ['id' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$'])]
    public function byQuestion(CollectiviteAnswerRepository $collectiviteAnswerRepository, Question $question): Response
    {
        $collectivite = $this->getUser()->getCollectivite();
        $collectiviteAnswers = $collectiviteAnswerRepository->findbyQuestion($collectivite, $question);

        return $this->json($collectiviteAnswers, 200, [], ['groups' => 'collectiviteAnswer']);
    }

    #[Route('/by-question/{id}', name: 'delete_by_question', methods: ['DELETE'], requirements: ['id' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$'])]
    public function delete(CollectiviteAnswerRepository $collectiviteAnswerRepository, Question $question): Response
    {
        $collectiviteAnswerRepository->deleteWithChildrenAnswers($this->getUser()->getCollectivite(), $question);
        return $this->json('', 204);
    }

    #[Route('', name: 'add', methods: ['POST'])]
    public function add(EntityManagerInterface $em, Request $request): Response
    {
        $collectivite = $this->getUser()->getCollectivite();
        $answer_id = $request->request->get('answer_id');
        $body = $request->request->get('body');

        $answer = $em->getRepository(Answer::class)->find($answer_id);
        
        if ($answer === null) {
            return $this->json(['error' => 'Answer not found with this id'], 404);
        }

        $collectiviteAnswer = new CollectiviteAnswer();
        $collectiviteAnswer
            ->setCollectivite($collectivite)
            ->setAnswer($answer)
            ->setBody($body)
            ->setAnsweredAt(new \DateTimeImmutable())
            ;
        $em->getRepository(CollectiviteAnswer::class)->save($collectiviteAnswer, true);

        return $this->json(['data' => $collectiviteAnswer], 201, [], ['groups' => 'collectiviteAnswer']);
    }
}
