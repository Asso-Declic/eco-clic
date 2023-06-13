<?php

namespace App\Controller\Api;

use App\Repository\CollectiviteRepository;
use App\Repository\TemporarySiretRepository;
use App\Service\InseeService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/collectivite', name: 'api_collectivite_')]
class CollectiviteController extends AbstractController
{
    #[Route('/by-opsn', name: 'by_opsn')]
    public function byOpsn(CollectiviteRepository $collectiviteRepository)
    {
        $collectivites = $collectiviteRepository->findBy(['opsn' => $this->getUser()->getOpsn()]);
        return $this->json($collectivites, 200, [], ['groups' => 'collectivite']);
    }

    #[Route('/check-siret/{siret}', name: 'check_siret', requirements: ['siret' => '\d{14}'])]
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

    #[Route('/check-siret-connu/{siret}', name: 'check_siret_connu', requirements: ['siret' => '\d{14}'])]
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
    public function infos(CollectiviteRepository $collectiviteRepository, EntityManagerInterface $em, InseeService $inseeService): Response
    {
        $collectivite = $this->getUser()->getCollectivite();

        // Si le code postal est null, on va le chercher grâce à l'API de l'INSEE
        // On le stocke en BDD pour ne pas avoir à le demander à chaque fois
        if ($collectivite->getPostalCode() == null) {
            $data = $inseeService->getPostalCode($collectivite->getSiret());
            $collectivite->setPostalCode($data['CodePostal']);
            $em->flush();
        }

        return $this->json($collectiviteRepository->findInfos($collectivite));
    }
}
