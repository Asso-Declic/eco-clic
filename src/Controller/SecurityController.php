<?php

namespace App\Controller;

use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route(name: 'security_')]
class SecurityController extends AbstractController
{
    #[Route(path: '/connexion', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('main_accueil');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/déconnexion', name: 'logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route('/inscription', name: 'registration')]
    public function registration(EntityManagerInterface $em, Request $request): Response
    {
        $form = $this->createForm(RegistrationType::class, options: ['csrf_protection' => false]);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $collectivite = $form->getData()['collectivite'];
            $user = $form->getData()['user_profile'];

            // Initialisation des valeurs initiales pour les deux objets
            // Il semblerait qu'on n'a pas systématiquement le département, la latitude et la longitude.
            $user->setCollectivite($collectivite);
            $user->setAdminCollectivite(true);
            $user->setCguChecked(true);

            $em->persist($collectivite);
            $em->persist($user);
            $em->flush();

            // Si on veut ajouter l'envoi d'un mail de confirmation ça se passe ici

            $this->addFlash('success', 'Votre compte a bien été créé. Vous pouvez vous connecter.');
            return $this->redirectToRoute('security_login');
        }

        return $this->render('security/registration.html.twig');
    }
}
