<?php

namespace App\Controller\Api;

use App\Entity\Answer;
use App\Entity\CollectiviteAnswer;
use App\Entity\Question;
use App\Entity\Log;
use App\Entity\User;
use App\Repository\CollectiviteAnswerRepository;
use App\Service\ScoreManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/collectivite-answers', name: 'api_collectivite_answer_')]
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
    public function add(EntityManagerInterface $em, Request $request, ScoreManager $scoreManager): Response
    {
        $user = $this->getUser();

        $collectivite = $user->getCollectivite();
        $answerId = $request->request->get('answer_id');
        $body = $request->request->get('body');

        $answer = $em->getRepository(Answer::class)->find($answerId);
        
        if ($answer === null) {
            return $this->json(['error' => 'Answer not found with this id'], 404);
        }

        $collectiviteAnswer = new CollectiviteAnswer();
        $collectiviteAnswer
            ->setCollectivite($collectivite)
            ->setAnswer($answer)
            ->setBody($body)
            ->setAnsweredAt(new \DateTimeImmutable())
            ->setUser($user)
            ;
        $em->getRepository(CollectiviteAnswer::class)->save($collectiviteAnswer, true);

        $category = $answer->getQuestion()->getCategory();
        // creation de log lors de la réponse
        $log = new Log();
        $log->setUsername($user->getUsername());
        $log->setUserid($user->getId());
        $log->setType("Réponse à une question de " . $category);

        $em->persist($log);
        $em->flush();

        // On tente de  créer un score pour cette catégorie
        // Si la catégorie est incomplète, le score ne sera pas créé
        $scoreManager->createAndSave($collectivite, $category);

        return $this->json(['data' => $collectiviteAnswer], 201, [], ['groups' => 'collectiviteAnswer']);
    }
}
