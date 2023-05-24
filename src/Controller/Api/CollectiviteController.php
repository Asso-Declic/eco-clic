<?php

namespace App\Controller\Api;

use App\Repository\CollectiviteRepository;
use App\Repository\TemporarySiretRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/collectivite', name: 'api_collectivite_')]
class CollectiviteController extends AbstractController
{
    // TODO : ajouter un requirement pour la forme du siret
    #[Route('/check-siret/{siret}', name: 'check_siret')]
    public function checkSiret(CollectiviteRepository $collectiviteRepository, string $siret)
    {
        /* Requête d'origine
        SELECT Siret FROM `collectivite` 
        WHERE Siret = :Siret
        */
        $collectivite = $collectiviteRepository->findOneBy(['siret' => $siret]);
        if ($collectivite == null) {
            return $this->json('');
        } else {
            return $this->json($collectivite->getSiret());
        }
    }

    // TODO : ajouter un requirement pour la forme du siret
    #[Route('/check-siret-connu/{siret}', name: 'check_siret_connu')]
    public function checkSiretConnu(TemporarySiretRepository $temporarySiretRepository, string $siret)
    {
        /* Requête d'origine
        SELECT Siret FROM `Siret_Temporaire` 
        WHERE Siret = :Sire
        */
        $temporarySiret = $temporarySiretRepository->findOneBy(['siret' => $siret]);
        if ($temporarySiret == null) {
            return $this->json('');
        } else {
            return $this->json($temporarySiret->getSiret());
        }
    }

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
