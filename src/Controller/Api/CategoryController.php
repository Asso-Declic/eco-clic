<?php

namespace App\Controller\Api;

use App\Entity\Category;
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
        $collectivite = $this->getUser()->getCollectivite();

        $categoryInfo = $categoryRepository->findInfos($collectivite);
        $totalQuestion = $categoryRepository->countAllQuestionsByCategory($collectivite);

        for ($i=0; $i < count($categoryInfo); $i++) { 
            for ($o=0; $o < count($totalQuestion); $o++) { 
                if ($categoryInfo[$i]['sort_order'] == $totalQuestion[$o]['sort_order']) {
                    $categoryInfo[$i]['nb_question'] = $totalQuestion[$o]['nb_question'];
                }
            }
        }

        return $this->json($categoryInfo);
    }

    #[Route('/all', name: 'all')]
    public function all(CategoryRepository $categoryRepository): Response
    {
        // "SELECT * FROM `categorie` order by `Ordre`
        return $this->json(['data' => $categoryRepository->findBy([], ['sortOrder' => 'ASC'])], 200, [], ['groups' => 'category']);
    }

    #[Route('/{id}', name: 'read', requirements: ['id' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$'])]
    public function read(Category $category): Response
    {
        return $this->json($category, 200, [], ['groups' => 'category']);
    }

    #[Route('/filters', name: 'filters')]
    public function filters(CategoryRepository $categoryRepository): Response
    {
        return $this->json(['data' => $categoryRepository->findFilters()], 200, [], ['groups' => 'category']);
    }
}
