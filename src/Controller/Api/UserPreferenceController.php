<?php

namespace App\Controller\Api;

use App\Entity\UserPreference;
use App\Repository\UserPreferenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/users/preference', name: 'api_user_preference_')]
class UserPreferenceController extends AbstractController
{
    #[Route('', name: 'read', methods: ['GET'])]
    public function read(Request $request, UserPreferenceRepository $userPreferenceRepository): JsonResponse
    {
        $code = $request->query->get('code');
        $userPreference = $userPreferenceRepository->findOneBy([
            'user' => $this->getUser(),
            'code' => $code,
        ]);

        return $this->json($userPreference, 200, [], ['groups' => 'userPreference']);
    }

    #[Route('', name: 'update', methods: ['PATCH', 'POST'])]
    public function update(EntityManagerInterface $em, Request $request, UserPreferenceRepository $userPreferenceRepository)
    {
        $code = $request->request->get('code');
        $json = $request->request->get('display');

        // ! Attention, on peut ajouter le nom de clé qu'on veut ici. Il serait intéressant, pour des raisons de sécurité, de vérifier que le code est bien dans une liste de codes autorisés.

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
