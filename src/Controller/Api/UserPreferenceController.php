<?php

namespace App\Controller\Api;

use App\Entity\UserPreference;
use App\Repository\UserPreferenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/utilisateur/preference', name: 'api_user_preference_')]
class UserPreferenceController extends AbstractController
{
    #[Route('/menu-categories', name: 'menu_categories')]
    public function menuCategories(UserPreferenceRepository $userPreferenceRepository): JsonResponse
    {
        $userPreference = $userPreferenceRepository->findOneBy([
            'user' => $this->getUser(),
            'code' => 'MENU_VISIBILITY',
        ]);
        return $this->json($userPreference);
    }

    #[Route('', name: 'update', methods: ['PATCH'])]
    public function update(EntityManagerInterface $em, Request $request, UserPreferenceRepository $userPreferenceRepository)
    {
        // Warning : L'algo devrait être fait pour stocker n'importe quel type de préférence mais ça ne garde apparemment que l'état du menu pour le moment, d'où le fait que ça stocke directement MENU_VISIBILITY
        $code = 'MENU_VISIBILITY';
        $json = $request->request->get('display');
        // Warning : Précédemment l'algorithme supprimait la préférence pour la recréer. Ici on la met à jour ou on la crée si elle n'existe pas. En principe c'est le même résultat
        $userPreference = $userPreferenceRepository->findOneBy(['user' => $this->getUser(), 'code' => $code]);
        if ($userPreference === null) {
            $userPreference = new UserPreference();
            $userPreference
                ->setUser($this->getUser())
                ->setCode($code);
                $em->persist($userPreference);
        }
        $userPreference->setJson($json);
        $em->flush();
        return $this->json($userPreference, 200, [], ['groups' => 'userPreference']);
    }
}
