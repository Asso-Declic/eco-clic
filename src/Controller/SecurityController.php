<?php

namespace App\Controller;

use App\Entity\Departement;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
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
    public function registration(EntityManagerInterface $em, Request $request, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $form = $this->createForm(RegistrationType::class, options: ['csrf_protection' => false]);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $collectivite = $form->getData()['collectivite'];
            $user = $form->getData()['user_profile'];

            // Initialisation des valeurs pour les deux objets
            // Il semblerait qu'on n'a pas systématiquement le département, la latitude et la longitude.
            $departement = $em->getRepository(Departement::class)->findOneBy(['code' => substr($collectivite->getPostalCode(),0,2)]);
            $collectivite->setDepartement($departement);

            $user->setCollectivite($collectivite);
            $user->setAdminCollectivite(true);
            $user->setCguChecked(true);
            $user->setActive(true);

            $passwordForm = $form->get('user_profile')->get('newPassword')->getData();
            $user->setPassword($userPasswordHasher->hashPassword($user, $passwordForm));
            
            $em->persist($collectivite);
            $em->persist($user);
            $em->flush();
            
            return $this->redirectToRoute('security_login');
        }

        return $this->render('security/registration.html.twig');
    }

    #[Route('/verificationemail/{token}', name: 'email_verification')]
    public function emailVerification(EntityManagerInterface $em, string $token): Response
    {
        
        $user = $em->getRepository(User::class)->findOneBy(['token' => $token]);
        
        $user->setVerified(true);
        
        $em->flush();

        return $this->redirectToRoute('security_login');
        
    }
}
