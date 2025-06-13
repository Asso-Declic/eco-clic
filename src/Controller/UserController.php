<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserProfileType;
use App\Repository\UserRepository;
use App\Service\MailingService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\MailerInterface;

#[Route('/utilisateur', name: 'user_')]
class UserController extends AbstractController
{

    public function __construct(
        private ResetPasswordHelperInterface $resetPasswordHelper,
        private EntityManagerInterface $entityManager
    ){
    }

    #[Route('/profil', name: 'profile')]
    public function profile(): Response
    {
        return $this->render('user/profile.html.twig');
    }

    #[Route('s', name: 'browse')]
    public function browse(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('user/browse.html.twig', [
            
        ]);
    }

    /**
     * Contrôleur d'ajout dans le cadre du formulaire de création d'un utilisateur
     * par une collectivité
     *
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param UserPasswordHasherInterface $passwordHasher
     * @return Response
     */
    #[Route('/add', name: 'add', methods: ['POST'])]
    public function add(EntityManagerInterface $em, MailingService $mailingService, Request $request, UserPasswordHasherInterface $passwordHasher, MailerInterface $mailer): Response
    {
        $currentUser = $this->getUser();
        $user = new User();
        $this->denyAccessUnlessGranted('USER_ADD', $user);

        $form = $this->createForm(UserProfileType::class, $user, ['csrf_protection' => false]);
        $userData = $request->request->all('user');

        // $password = $request->request->get('password');
        // $newHashedPassword = $passwordHasher->hashPassword($user, $password);
        // $user->setPassword($newHashedPassword);

        $isAdminCollectivite = $request->request->get('admin');
        if ($isAdminCollectivite=='on') {
            $user->setAdminCollectivite(true);
        }
        $user->setIsVu(false);
        $collectivite = $currentUser->getCollectivite();
        $user->setCollectivite($collectivite);

        $form->submit($userData);
        if ($form->isValid()) {
            $em->persist($user);
            $em->flush();

            // envoi du mail de reinitialisation de mot de passe
            $userForToken = $this->entityManager->getRepository(User::class)->findOneBy([
                'email' => $user->getEmail(),
            ]);

            $resetToken = $this->resetPasswordHelper->generateResetToken($userForToken);

            $email = (new TemplatedEmail())
                ->from(new Address($_ENV["MAILER_FROM_ADDRESS"], $_ENV["MAILER_FROM_NAME"]))
                ->to($user->getEmail())
                ->subject('Votre demande de réinitialisation de mot de passe')
                ->htmlTemplate('reset_password/email.html.twig')
                ->context([
                    'resetToken' => $resetToken,
                ])
            ;

            $mailer->send($email);

            $mailingService->InscriptionUtilisateur($user->getEmail(), $user->getToken());
        }
            
        return $this->redirectToRoute('user_browse');
    }

    /**
     * Contrôleur d'ajout dans le cadre du formulaire de création d'un utilisateur
     * par une collectivité
     *
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     */
    #[Route('/edit', name: 'edit', methods: ['POST'])]
    public function edit(EntityManagerInterface $em, Request $request): Response
    {
        $userData = $request->request->all();
        // L'id n'est pas dans l'url mais dans le formulaire
        // On récupère l'utilisateur à modifier ici
        $user = $em->getRepository(User::class)->find($request->request->get('id'));
        
        $currentUser = $this->getUser();
        $this->denyAccessUnlessGranted('USER_UPDATE', $user);

        $form = $this->createForm(UserProfileType::class, $user, ['csrf_protection' => false]);

        $isAdminCollectivite = $request->request->get('adminCollectivite');
        if ($isAdminCollectivite=='on') {
            $user->setAdminCollectivite($isAdminCollectivite == 'on');
        } else {
            $user->setAdminCollectivite(false);
        }

        $collectivite = $currentUser->getCollectivite();
        $user->setCollectivite($collectivite);

        // On modifie les données reçus pour coller avec le formulaire, ceci est une bidouille à revoir
        $userData = [
            'username' => $userData['username'],
            'email' => $userData['email'],
            'firstName' => $userData['firstName'],
            'lastName' => $userData['lastName'],
            'active' => $user->isActive(),
        ];

        $form->submit($userData);
        if ($form->isValid()) {
            $em->flush();
        }
            
        return $this->redirectToRoute('user_browse');
    }
}
