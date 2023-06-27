<?php

namespace App\Controller\Api;

use App\Form\UserProfilType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

#[Route('/api/user', name: 'api_user_')]
class UserController extends AbstractController
{
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

    #[Route('/current', name: 'get_current')]
    public function getCurrent()
    {
        // JSON de retour d'origine
        // {"Nom": ---,"Prenom": ---,"Mail": ---,"CollectiviteId": ---,"Identifiant": ---,"Actif": 1/0, "Admin": 1/0,"Id": ---}
        // Mais le JS ne semble utiliser que : Id, Nom, Prenom, Identifiant, Mail
        // donc le group "user" a été conçu en ce sens
        return $this->json($this->getUser(), 200, [], ['groups' => 'user']);
    }

    #[Route('', name: 'update', methods: ['PUT'])]
    public function update(EntityManagerInterface $em, Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserProfilType::class, $user, [
            'csrf_protection' => false,
        ]);
        $data = json_decode($request->getContent(), true);
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
            $em->flush();
            
            return $this->json($user, 200, [], ['groups' => 'user']);
        }
        return $this->json((string) $form->getErrors());
    }
}
