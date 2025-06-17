<?php

namespace App\Controller\Api;

use App\Entity\Recommandation;
use App\Entity\CollectiviteStatus;
use App\Entity\RecommandationPerso;
use App\Entity\RecommandationStatus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CollectiviteStatusRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/collectivite-statuses', name: 'api_collectivite_status_')]
class CollectiviteStatusController extends AbstractController
{
    #[Route(
        '/{id}/{status}',
        name: 'set',
        methods: ['POST', 'PUT'],
        requirements: ['id' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$', 'status' => '\d+']
    )]
    public function set(
    string $id,
    RecommandationStatus $status,
    EntityManagerInterface $em,
    CollectiviteStatusRepository $collectiviteStatusRepository
): JsonResponse {
    $recommandationPerso = $em->getRepository(RecommandationPerso::class)->find($id);

    if ($recommandationPerso !== null) {
        // Cas 1 : c'est une recommandation perso
        $recommandationPerso->setStatus($status);
        $em->flush();
        return $this->json(['message' => 'Statut mis à jour pour RecommandationPerso.'], Response::HTTP_OK);
    }

    // Cas 2 : c'est une recommandation générique
    $recommandation = $em->getRepository(Recommandation::class)->find($id);
    if ($recommandation === null) {
        return $this->json(['error' => 'Recommandation non trouvée.'], Response::HTTP_NOT_FOUND);
    }

    $collectivite = $this->getUser()->getCollectivite();
    $collectiviteStatus = $collectiviteStatusRepository->findOneBy([
        'recommandation' => $recommandation,
        'collectivite' => $collectivite,
    ]);

    if ($collectiviteStatus === null) {
        $collectiviteStatus = new CollectiviteStatus();
        $collectiviteStatus->setRecommandation($recommandation);
        $collectiviteStatus->setCollectivite($collectivite);
        $collectiviteStatus->setStatus($status);
        $em->persist($collectiviteStatus);
        $statusCode = Response::HTTP_CREATED;
    } else {
        $collectiviteStatus->setStatus($status);
        $statusCode = Response::HTTP_OK;
    }

    $em->flush();

    return $this->json($collectiviteStatus, $statusCode, [], ['groups' => 'collectivite_status']);
}
}
