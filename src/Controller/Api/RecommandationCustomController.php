<?php

namespace App\Controller\Api;

use App\Entity\Category;
use App\Entity\Question;
use App\Entity\Collectivite;
use App\Entity\Recommandation;
use App\Entity\RecommandationLevel;
use App\Entity\RecommandationPerso;
use App\Entity\RecommandationCustom;
use App\Entity\RecommandationStatus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecommandationPersoRepository;
use App\Repository\RecommandationCustomRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/recommendation-customs', name: 'api_recommandation_custom_')]
class RecommandationCustomController extends AbstractController
{
    #[Route('/by-category/{category}/{collectivite}', name: 'by_category')]
    public function byCategory(Category $category, Collectivite $collectivite, RecommandationCustomRepository $recommandationCustomRepository): JsonResponse
    {
        $recommandationCustoms = $recommandationCustomRepository->findByCategoryWithQuestions($category, $collectivite);
        return $this->json($recommandationCustoms, 200, [], ['groups' => ['recommandation_custom', 'question']]);
    }

    #[Route('', name: 'add', methods: ['POST'])]
    public function add(EntityManagerInterface $em, Request $request, RecommandationCustomRepository $recommandationCustomRepository): JsonResponse
    {
        $data = $request->request->all();

        $collectivite = $em->getRepository(Collectivite::class)->find($data['collectivite']);
        $question = $em->getRepository(Question::class)->find($data['question']);
        
        $recommandationCustoms = $recommandationCustomRepository->delete($data['collectivite'], $data['question']);
        
        if ($data['recommandations'] != '') {
            foreach($data['recommandations'] as $recommandation) {
                
                $recommandation = $em->getRepository(Recommandation::class)->find($recommandation);
                
                $recommandationCustom = new RecommandationCustom();
                $recommandationCustom->setRecommandation($recommandation);
                $recommandationCustom->setCollectivite($collectivite);
                $recommandationCustom->setQuestion($question);

                $em->persist($recommandationCustom);
            }
            $em->flush();
        }

        return $this->json(['message' => 'ok'], 200);
    }

    #[Route('/perso', name: 'addPerso', methods: ['POST'])]
    public function addPerso(EntityManagerInterface $em, Request $request, RecommandationPersoRepository $recommandationPersoRepository): JsonResponse
    {
        $data = $request->request->all();

        $collectivite = $em->getRepository(Collectivite::class)->find($data['collectivite']);
        $question = $em->getRepository(Question::class)->find($data['question']);
        $level = $em->getRepository(RecommandationLevel::class)->find("1");
        $status = $em->getRepository(RecommandationStatus::class)->find("4");
        
        $recommandationPerso = $recommandationPersoRepository->delete($data['collectivite'], $data['question']);
        
        if ($data['recommandation'] != '') {
            
            $recommandationPerso = new RecommandationPerso();
            $recommandationPerso->setTitle($question->getQuestion());
            $recommandationPerso->setBody($data['recommandation']);
            $recommandationPerso->setQuestion($question);
            $recommandationPerso->setCollectivite($collectivite);
            $recommandationPerso->setLevel($level);
            $recommandationPerso->setStatus($status);

            $em->persist($recommandationPerso);
            $em->flush();
        }

        return $this->json(['message' => 'ok'], 200);
    }
}
