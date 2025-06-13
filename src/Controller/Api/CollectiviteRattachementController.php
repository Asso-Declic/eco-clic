<?php

namespace App\Controller\Api;

use App\Entity\Collectivite;
use App\Entity\OPSN;
use App\Service\MailingService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/collectivite/rattachement', name: 'api_collectivite_rattachement_')]
class CollectiviteRattachementController extends AbstractController
{
    public function __construct(
        private MailingService $mailingService
    ) {}

    #[Route('/accept/{id}', name: 'opsn_accept', methods: ['POST'])]
    public function accept(Collectivite $collectivite, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER_OPSN');

        $opsn = $this->getUser()->getOpsn();

        $collectivite->setLinkDemand(null);
        $collectivite->setOpsn($opsn);
        $em->flush();

        $to = $this->mailingService->getEmailCollectivite($collectivite);
        $this->mailingService->acceptOPSN($to, $collectivite->getName(), $opsn->getName());

        return $this->json($collectivite, 200, [], ['groups' => 'collectivite']);
    }

    #[Route('', name: 'browse', methods: ['GET'])]
    public function browse(): Response
    {
        $collectivite = $this->getUser()->getCollectivite();

        return $this->json($collectivite->getLinkDemand(), 200, [], ['groups' => 'link_demand']);
    }

    #[Route('', name: 'cancel_demand', methods: ['DELETE'])]
    public function cancelDemand(EntityManagerInterface $em): Response
    {
        $collectivite = $this->getUser()->getCollectivite();
        $opsn = $collectivite->getLinkDemand();

        $collectivite->setLinkDemand(null);
        $em->flush();

        $this->mailingService->CancelOPSN($opsn->getEmail(), $collectivite->getName(), $opsn->getName());

        return $this->json($collectivite->getLinkDemand(), 200, [], ['groups' => 'link_demand']);
    }

    #[Route('/{id}', name: 'cancel_demand_by_posn', methods: ['DELETE'])]
    public function cancelDemandByOpsn(Collectivite $collectivite, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER_OPSN');
        $opsn = $this->getUser()->getOpsn();

        $collectivite->setLinkDemand(null);
        $em->flush();

        $to = $this->mailingService->getEmailCollectivite($collectivite);
        $this->mailingService->RefuseOPSN($to, $collectivite->getName(), $opsn->getName());

        return $this->json($collectivite->getLinkDemand(), 200, [], ['groups' => 'link_demand']);
    }

    #[Route('/{id}', name: 'send_demand', methods: ['POST'])]
    public function sendDemand(EntityManagerInterface $em, OPSN $opsn): Response
    {
        $collectivite = $this->getUser()->getCollectivite();
        $collectivite->setLinkDemand($opsn);
        $em->flush();

        $this->mailingService->DemandOPSN($opsn->getEmail(), $collectivite->getName(), $opsn->getName());

        return $this->json($collectivite->getLinkDemand(), 201, [], ['groups' => 'link_demand']);
    }
}
