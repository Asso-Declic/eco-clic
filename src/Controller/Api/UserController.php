<?php

namespace App\Controller\Api;

use App\Form\UserProfilType;
use App\Repository\CollectiviteRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

// TODO : Pour faire propre il faudrait envoyer un json qui dit true ou false ou une erreur
// TODO : Voir pour faire une seule requête vers le serveur avec les deux checks et l'API de l'INSEE
#[Route('/api/user', name: 'api_user_')]
class UserController extends AbstractController
{
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
                // TODO : Vérifier que le mot de passe comporte au minimum 12 caractères dont : une minuscule, une majuscule, un chiffre et un caractère spécial : /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[+\-_!@#\$%\^&\*])(?=.{12,})/
                if ($newPassword != null) {
                    $newHashedPassword = $passwordHasher->hashPassword($user, $newPassword);
                    $user->setPassword($newHashedPassword);
                }
                $em->flush();
            }

            // TODO : Savoir afficher un message en cas d'erreur pour prévenir l'utilisateur
            // En cas de mauvais mot de passe
            // En cas de formulaire invalide (plusieurs messages possibles et pré-enregistrés)
            return $this->json($user, 200, [], ['groups' => 'user']);
        }
        return $this->json((string) $form->getErrors());
    }
}
