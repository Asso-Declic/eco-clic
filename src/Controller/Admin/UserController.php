<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Collectivite;
use App\Entity\OPSN;
use App\Form\UserProfileType;
use App\Repository\UserRepository;
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

#[Route('/admin/utilisateurs', name: 'admin_user_')]
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
        return $this->render('admin/user/profile.html.twig');
    }

    /**
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     */
    #[Route('/add', name: 'add', methods: ['POST'])]
    public function add(EntityManagerInterface $em, Request $request, UserPasswordHasherInterface $passwordHasher, MailerInterface $mailer): Response
    {
        $currentUser = $this->getUser();
        $user = new User();
        $form = $this->createForm(UserProfileType::class, $user, [
            'csrf_protection' => false,
        ]);
        $form->submit($request->request->all('user'));

        $Data = $request->request->all('user');

        if (isset($Data["opsn"])) {
            $collectivite = $em->getRepository(Collectivite::class)->find($Data["opsn"]);
            $opsn = $em->getRepository(OPSN::class)->find($Data["opsn"]);
            $user->setCollectivite($collectivite);
            $user->setOpsn($opsn);
        } else {
            $user->setCollectivite($currentUser->getCollectivite());
            $user->setOpsn($currentUser->getOpsn());
        }
        $user->setIsVu(false);
        $user->setAdminCollectivite(true);
        $user->setAdminOPSN(true);

        if ($form->isSubmitted() && $form->isValid()) {
            // $newPassword = $form->get('newPassword')->getData();
            // if ($newPassword != null) {
            //     $newHashedPassword = $passwordHasher->hashPassword($user, $newPassword);
            //     $user->setPassword($newHashedPassword);
            // }

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

        }
        return $this->redirectToRoute('admin_user_browse');
    }

    #[Route('', name: 'browse')]
    public function browse(UserRepository $userRepository): Response
    {
        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            $users = $userRepository->findAll();
        } else {
            $users = $userRepository->findBy(['opsn' => $this->getUser()->getOpsn()]);
        }

        return $this->render('admin/user/browse.html.twig', [
            'users' => $users,
        ]);
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
        if ($user->getOpsn() == null) {
            $opsnId = null;
        } else {
            $opsnId = $user->getOpsn()->getId();
        }
        $userData = [
            'username' => $userData['username'],
            'email' => $userData['email'],
            'firstName' => $userData['firstName'],
            'lastName' => $userData['lastName'],
            'active' => $user->isActive(),
            'opsn' => $opsnId,
        ];
        
        $form->submit($userData);
        if ($form->isValid()) {
            $em->flush();
        }
            
        return $this->redirectToRoute('admin_user_browse');
    }
}
