<?php

namespace App\Controller\Api;

use App\Entity\Collectivite;
use App\Repository\CollectiviteRepository;
// use App\Repository\TemporarySiretRepository;
use App\Service\InseeService;
use App\Service\ProgressionManager;
use App\Service\ScoreManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

#[Route('/api/collectivites', name: 'api_collectivite_')]
class CollectiviteController extends AbstractController
{
    /**
     * Rrtourne les collectivités de l'OPSN avec leur progression et leur score
     * 
     * @param CollectiviteRepository $collectiviteRepository
     */
    #[Route('/by-opsn', name: 'by_opsn')]
    public function byOpsn(CollectiviteRepository $collectiviteRepository, ProgressionManager $progressionManager, ScoreManager $scoreManager)
    {
        $opsn = $this->getUser()->getOpsn();
        $collectivites = $collectiviteRepository->findBy(['opsn' => $opsn]);
        
        $tableRows = [];
        foreach ($collectivites as $collectivite) {
            $progression = $progressionManager->getGlobalPercentage($collectivite);
            $score = $scoreManager->getCurrentLetter($collectivite, false);
            $progressionDetails = $progressionManager->get($collectivite);
            $tableRows[] = [
                'collectivite' => $collectivite,
                'progression' => $progression . ' %',
                'progressionDetails' => $progressionDetails,
                'score' => $progression == 100 ? $score : 'N/A',
            ];
        }

        return $this->json($tableRows, 200, [], ['groups' => 'collectivite']);
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

    // #[Route('/check-siret-connu/{siret}', name: 'check_siret_connu', requirements: ['siret' => '\d{14}'])]
    // public function checkSiretConnu(TemporarySiretRepository $temporarySiretRepository, string $siret)
    // {
    //     /* Requête d'origine
    //     SELECT Siret FROM `Siret_Temporaire` 
    //     WHERE Siret = :Sire
    //     */
    //     $temporarySiret = $temporarySiretRepository->findOneBy(['siret' => $siret]);
    //     if ($temporarySiret == null) {
    //         return $this->json('');
    //     } else {
    //         return $this->json($temporarySiret->getSiret());
    //     }
    // }

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

    #[Route('/update-level/{id}', name: 'update_level', methods: ['PATCH'])]
    public function updateLevel(EntityManagerInterface $em, Collectivite $collectivite, TokenStorageInterface $token): Response
    {
        // Vérifier que l'utilisateur connecté a le droit de modifier l'utilisateur ciblé
        $this->denyAccessUnlessGranted('COLLECTIVITE_UPDATE_LEVEL_TWO', $collectivite);

        $collectivite->setLevelTwo(!$collectivite->isLevelTwo());
        $em->flush();

        // Patch pour éviter d'être déconnecté après avoir modifié l'utilisateur
        $token->setToken(
            new UsernamePasswordToken($this->getUser(), 'main', $this->getUser()->getRoles())
        );
            
        return $this->json($collectivite, 200, [], ['groups' => 'collectivite']);
    }

    #[Route('/demanding', name: 'get_demanding', methods: ['GET'])]
    public function getDemanding(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER_OPSN');
        
        $opsn = $this->getUser()->getOpsn();
        return $this->json($opsn->getLinkDemands(), 200, [], ['groups' => 'collectivite']);
    }
}
