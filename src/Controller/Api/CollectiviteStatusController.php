<?php

namespace App\Controller\Api;

use App\Entity\CollectiviteStatus;
use App\Entity\Recommandation;
use App\Entity\RecommandationStatus;
use App\Repository\CollectiviteStatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/collectivite-statuses', name: 'api_collectivite_status_')]
class CollectiviteStatusController extends AbstractController
{
    #[Route(
        '/{recommandation}/{status}',
        name: 'set',
        methods: ['POST', 'PUT'],
        requirements: ['recommandation' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$', 'status' => '\d+']
    )]
    public function set(CollectiviteStatusRepository $collectiviteStatusRepository, EntityManagerInterface $em, Recommandation $recommandation, RecommandationStatus $status): JsonResponse
    {
        /*
        La logique originale créait un statut pour chaque recommandation dès l'inscription
        Aucune création de statut n'existait autrement. Changeons cette logique pour éviter des statuts inutiles en BDD
        et pour éviter des déconvenus en cas de bug de la base de données. Lors d'un update, si le statut n'existe pas, on le crée.
        */
        $collectivite = $this->getUser()->getCollectivite();
        $collectiviteStatus = $collectiviteStatusRepository->findOneBy(['recommandation' => $recommandation, 'collectivite' => $collectivite]);

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
