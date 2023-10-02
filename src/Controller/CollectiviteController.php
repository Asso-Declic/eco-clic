<?php

namespace App\Controller;

use App\Entity\Collectivite;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

#[Route('/collectivite', name: 'collectivite_')]
class CollectiviteController extends AbstractController
{
    #[Route('/rattachement-opsn', name: 'link_opsn')]
    public function linkOpsn(): Response
    {
        return $this->render('collectivite/link_opsn.html.twig', [
        ]);
    }

    /**
     * Attention il ne s'agit pas de la fonctionnalité d'impersonation de Symfony
     * Ici, on rattache la collectivité à l'utilisateur s'il représente une OPSN et qu'il veut voir le questionnaire de la collectivite
     */
    #[Route('/impersonate/{id}', name: 'impersonate')]
    public function impersonate(Collectivite $collectivite, EntityManagerInterface $em, TokenStorageInterface $token): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER_OPSN');

        if ($collectivite->getOpsn() == $this->getUser()->getOpsn()) {
            $this->getUser()->setCollectivite($collectivite);
            $em->flush();

            // Patch pour éviter d'être déconnecté après avoir modifié l'utilisateur
            $token->setToken(
                new UsernamePasswordToken($this->getUser(), 'main', $this->getUser()->getRoles())
            );
        }

        return $this->redirectToRoute('main_accueil');
    }
}
