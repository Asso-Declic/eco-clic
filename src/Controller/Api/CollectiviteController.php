<?php

namespace App\Controller\Api;

use App\Repository\CollectiviteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/collectivite', name: 'api_collectivite_')]
class CollectiviteController extends AbstractController
{
    #[Route('/infos', name: 'infos')]
    public function infos(CollectiviteRepository $collectiviteRepository): Response
    {
        $collectivite = $this->getUser()->getCollectivite();
        $data = $collectiviteRepository->findInfos($collectivite);
        return $this->json($data);
    }

    #[Route('/progression', name: 'progression')]
    public function progression(CollectiviteRepository $collectiviteRepository): Response
    {
        $collectivite = $this->getUser()->getCollectivite();
        $data = $collectiviteRepository->findProgression($collectivite);
        return $this->json(["data" => $data]);
    }
}
