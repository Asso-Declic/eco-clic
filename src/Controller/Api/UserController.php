<?php

namespace App\Controller\Api;

use App\Repository\CollectiviteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// TODO : Pour faire propre il faudrait envoyer un json qui dit true ou false ou une erreur
// TODO : Voir pour faire une seule requête vers le serveur avec les deux checks et l'API de l'INSEE
#[Route('/api/user', name: 'api_user_')]
class UserController extends AbstractController
{
    #[Route('/current', name: 'current')]
    public function current()
    {
        // JSON de retour d'origine
        // {"Nom": ---,"Prenom": ---,"Mail": ---,"CollectiviteId": ---,"Identifiant": ---,"Actif": 1/0, "Admin": 1/0,"Id": ---}
        // Mais le JS ne semble utiliser que : Id, Nom, Prenom, Identifiant, Mail
        // donc le group "user" a été conçu en ce sens
        return $this->json($this->getUser(), 200, [], ['groups' => 'user']);
    }
}
