<?php

namespace App\Controller\Api;

use App\Entity\Category;
use App\Entity\Collectivite;
// use App\Repository\TemporarySiretRepository;
use App\Entity\Notification;
use App\Service\InseeService;
use App\Service\ScoreManager;
use App\Service\ProgressionManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CollectiviteRepository;
use App\Repository\NotificationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

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

    /**
     * Retourne les collectivités de l'OPSN avec leur progression et leur score
     * 
     * @param CollectiviteRepository $collectiviteRepository
     */
    #[Route('/all_col', name: 'all_col')]
    public function allCol(CollectiviteRepository $collectiviteRepository, ProgressionManager $progressionManager, ScoreManager $scoreManager): JsonResponse 
    {
        $results = $this->getCollectiviteData($collectiviteRepository, $progressionManager, $scoreManager);

        return $this->json($results, 200, [], ['groups' => 'collectivite']);
    }

    private function getCollectiviteData(CollectiviteRepository $collectiviteRepository, ProgressionManager $progressionManager, ScoreManager $scoreManager): array 
    {
        $collectivites = $collectiviteRepository->findAll();
        $tableRows = [];

        foreach ($collectivites as $collectivite) {
            $progression = $progressionManager->getGlobalPercentage($collectivite);
            $score = $scoreManager->getCurrentLetter($collectivite, false);
            $progressionDetails = $progressionManager->get($collectivite);

            $tableRows[] = [
                'collectivite' => $collectivite->getName(),
                'type' => $collectivite->getType()->getLabel(),
                'departement' => $collectivite->getDepartement()->getCode(),
                'progression' => $progression . ' %',
                'progressionDetails' => $progressionDetails,
                'score' => $progression == 100 ? $score : 'N/A',
            ];
        }

        return $tableRows;
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
        $this->denyAccessUnlessGranted('ROLE_USER_OPSN', $collectivite);

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

    #[Route('/detach/{id}', name: 'detach', methods: ['DELETE'])]
    public function detach(Collectivite $collectivite, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER_OPSN');
        
        $collectivite->setOpsn(null);
        $em->flush();

        return $this->json($collectivite, 200, [], ['groups' => 'collectivite']);
    }

    #[Route('/notif', name: 'get_notif', methods: ['GET'])]
    public function getNotif(NotificationRepository $notificationRepository): Response
    {
        $collectivite = $this->getUser()->getCollectivite();
        $notifications = $notificationRepository->findByCol($collectivite->getId());
    
        return $this->json(['data' => $notifications], 200, [], ['groups' => 'notification']);   
    }

    #[Route('/deleteNotif/{id}', name: 'deleteNotif', methods: ['DELETE'])]
    public function delete(NotificationRepository $notificationRepository, Notification $notification): Response
    {
        $notificationRepository->deleteNotification($notification);
    }

    #[Route('/deleteAllNotif', name: 'deleteAllNotif', methods: ['DELETE'])]
    public function deleteAll(NotificationRepository $notificationRepository): Response
    {
        $notificationRepository->deleteAllNotification($this->getUser()->getCollectivite()->getId());
    }

    #[Route('/addNotif', name: 'addNotif', methods: ['POST'])]
    public function add(EntityManagerInterface $em, Request $request): JsonResponse
    {
        $data = $request->request->all();

        $date = new \DateTimeImmutable();
        $date->format('Y-m-d H:i:s');
        
        if (isset($data['categorie'])) {
            $category = $em->getRepository(Category::class)->find($data['categorie']);
            $notification = new Notification();
            $notification->setCollectivite($this->getUser()->getCollectivite());
            $notification->setCategory($category);
            $notification->setPostedAt($date);

            $em->persist($notification);
            $em->flush();
        }

        return $this->json(['message' => 'ok'], 200);
    }

    #[Route('/downloadCCT/{extract}', name: 'downloadCCT')]
    public function downloadCCT(bool $extract, collectiviteRepository $collectiviteRepository): JsonResponse
    {
        $results = $collectiviteRepository->download_CC_Thelloise();

        if ($extract == 1) {
            $filename = "CC_Thelloise" . date('d-m-Y') . ".csv";

            header("Content-Disposition: attachment; filename=\"$filename\"");
            header("Content-Type: text/csv;charset=UTF-8");
            echo "\xEF\xBB\xBF"; // UTF-8 BOM

            $out = fopen("php://output", 'w');

            $flag = FALSE;

            foreach($results as $record) {
                if(!$flag) {
                    fputcsv($out, array_keys($record), ';', '"');
                    $flag = TRUE;
                }
                fputcsv($out, array_values($record), ';', '"');
            }

            fclose($out);

            exit;
        } else {
            return $this->json(['data' => $results]);
        }
    }
}
