<?php

namespace App\Controller\Api;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/category', name: 'api_category_')]
class CategoryController extends AbstractController
{
    #[Route('/infos', name: 'infos')]
    public function infos(CategoryRepository $categoryRepository): Response
    {
        return $this->json(['data' => $categoryRepository->findInfos()]);
    }

    #[Route('/all', name: 'all')]
    public function all(CategoryRepository $categoryRepository): Response
    {
        // "SELECT * FROM `categorie` order by `Ordre`
        return $this->json(['data' => $categoryRepository->findBy([], ['sortOrder' => 'ASC'])], 200, [], ['groups' => 'category']);
    }
}
