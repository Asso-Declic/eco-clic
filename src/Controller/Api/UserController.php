<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Service\MailingService;
use App\Security\Voter\UserVoter;
use App\Repository\UserRepository;
use App\Form\CurrentUserProfileType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CollectiviteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

#[Route('/api/users', name: 'api_user_')]
class UserController extends AbstractController
{
    #[Route('', name: 'browse', methods: ['GET'])]
    public function browse(UserRepository $userRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_OPSN');
        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            $users = $userRepository->findAll();
        } else {
            $users = $userRepository->findBy(['opsn' => $this->getUser()->getOpsn()]);
        }
        return $this->json($users, 200, [], ['groups' => 'user']);
    }

    #[Route('/by-collectivite', name: 'by_collectivite')]
    public function byCollectivite(UserRepository $userRepository): Response
    {
        $user = $this->getUser();
        $collectivite = $user->getCollectivite();
        $users = $userRepository->findBy(['collectivite' => $collectivite], ['lastName' => 'ASC']);

        return $this->json($users, 200, [], [
            'groups' => 'user',
            // Côté front, on manipule la valeur «self», elle a donc été recréée au moment de la sérialisation
            AbstractNormalizer::CALLBACKS => [
                'active' => function ($innerObject, $outerObject) use ($user) {
                    if ($outerObject == $user) { return 'self'; }
                    return $innerObject;
                },
                'admin' => function ($innerObject, $outerObject) use ($user) {
                    if ($outerObject == $user) { return 'self'; }
                    return $innerObject;
                }],
        ]);
    }

    #[Route('/check-username/{username}', name: 'check_username')]
    public function checkUsername(string $username, UserRepository $userRepository)
    {
        /* Requête d'origine
            SELECT Identifiant FROM `utilisateur` 
            WHERE Identifiant = :Identifiant
        */
        $user = $userRepository->findOneBy(['username' => $username]);
        if ($user == null) {
            return $this->json('');
        } else {
            return $this->json($user->getUsername());
        }
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(EntityManagerInterface $em, User $user): Response
    {
        // Vérifier que l'utilisateur connecté a le droit de supprimer l'utilisateur ciblé
        $this->denyAccessUnlessGranted('USER_DELETE', $user);

        $em->remove($user);
        $em->flush();
            
        return $this->json('', 201);
    }

    #[Route('/current', name: 'get_current', methods: ['GET'])]
    public function getCurrent()
    {
        // JSON de retour d'origine
        // {"Nom": ---,"Prenom": ---,"Mail": ---,"CollectiviteId": ---,"Identifiant": ---,"Actif": 1/0, "Admin": 1/0,"Id": ---}
        // Mais le JS ne semble utiliser que : Id, Nom, Prenom, Identifiant, Mail
        // donc le group "user" a été conçu en ce sens
        return $this->json($this->getUser(), 200, [], ['groups' => 'user']);
    }

    #[Route('/resend-email/{id}', name: 'resend_verification_email', methods: ['POST'])]
    public function resendVerificationEmail(MailingService $mailingService, User $user): Response
    {
        $mailingService->InscriptionUtilisateur($user->getEmail(), $user->getToken());
        return $this->json('ok');
    }

    #[Route('/current', name: 'update-current', methods: ['PUT'])]
    public function updateCurrent(EntityManagerInterface $em, Request $request, TokenStorageInterface $token, UserPasswordHasherInterface $passwordHasher): Response
    {
        $changed = 0;
        $user = $this->getUser();
        $this->denyAccessUnlessGranted(UserVoter::UPDATE, $user);
        
        $data = json_decode($request->getContent(), true);
        $form = $this->createForm(CurrentUserProfileType::class, $user, ['csrf_protection' => false]);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $oldPassword = $form->get('oldPassword')->getData() ?? '';
            $newPassword = $form->get('newPassword')->getData(); // est null si les deux champs sont vides ou sont différents
            if ($passwordHasher->isPasswordValid($user, $oldPassword)) {
                if ($newPassword != null) {
                    $newHashedPassword = $passwordHasher->hashPassword($user, $newPassword);
                    $user->setPassword($newHashedPassword);
                    $this->addFlash('success', 'Votre mot de passe à bien été modifié');
                }
            }

            $em->flush();

            $token->setToken(
                new UsernamePasswordToken($this->getUser(), 'main', $this->getUser()->getRoles())
            );

            return $this->json($user, 200, [], ['groups' => 'user']);
        }
        $this->addFlash('error', 'Les conditions pour le changement de mot de passe ne sont pas réspecter');
        return $this->json((string) $form->getErrors());
    }

    #[Route('', name: 'update', methods: ['PUT'])]
    public function update(EntityManagerInterface $em, Request $request, TokenStorageInterface $token, UserPasswordHasherInterface $passwordHasher): Response
    {
        $data = json_decode($request->getContent(), true);
        $user = $this->getUser();
        $form = $this->createForm(UserProfileType::class, $user, [
            'csrf_protection' => false,
        ]);
        $form->submit($data);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $oldPassword = $form->get('oldPassword')->getData() ?? '';
            $newPassword = $form->get('newPassword')->getData(); // est null si les deux champs sont vides ou sont différents
            if ($passwordHasher->isPasswordValid($user, $oldPassword)) {
                if ($newPassword != null) {
                    $newHashedPassword = $passwordHasher->hashPassword($user, $newPassword);
                    $user->setPassword($newHashedPassword);
                }
            }
            // $user->setActive(true);

            $this->denyAccessUnlessGranted('UPDATE_USER', $user);

            $em->flush();

            // Au cas où un admin se modifie lui-même
            $token->setToken(
                new UsernamePasswordToken($this->getUser(), 'main', $this->getUser()->getRoles())
            );
            
            return $this->json($user, 200, [], ['groups' => 'user']);
        }
        return $this->json((string) $form->getErrors());
    }

    #[Route('/update-active/{id}', name: 'update_active', methods: ['PATCH'])]
    public function updateActive(EntityManagerInterface $em, User $user): Response
    {
        // Vérifier que l'utilisateur connecté a le droit de modifier l'utilisateur ciblé
        $this->denyAccessUnlessGranted('USER_DEACTIVATE', $user);

        $user->setActive(!$user->isActive());
        $em->flush();
            
        return $this->json($user, 200, [], ['groups' => 'user']);
    }

    #[Route('/update-isVu', name: 'update_isVu', methods: ['PATCH'])]
    public function updateIsVu(EntityManagerInterface $em, UserRepository $userRepository): Response
    {
        $userRepository->updateIsVu($this->getUser());
        return $this->json('', 204);
    }
}
