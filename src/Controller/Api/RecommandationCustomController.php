<?php

namespace App\Controller\Api;

use App\Entity\Category;
use App\Entity\Collectivite;
use App\Entity\Question;
use App\Entity\Recommandation;
use App\Entity\RecommandationCustom;
use App\Repository\RecommandationCustomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
        
        if (isset($data['recommandations'])) {
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
}