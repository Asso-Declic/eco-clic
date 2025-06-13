<?php

namespace App\Controller\Admin;

use App\Entity\Question;
use App\Form\QuestionType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/questions', name: 'admin_question_')]
class QuestionController extends AbstractController
{
    #[Route('', name: 'browse')]
    public function browse(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findWithQuestions();
        return $this->render('admin/question/browse.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/{id}', name: 'edit', methods: ['GET', 'POST'], requirements: ['id' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$'])]
    public function edit(Question $question): Response
    {
        $form = $this->createForm(QuestionType::class, $question);

        return $this->render('admin/question/edit.html.twig', [
            'form' => $form->createView(),
            'question' => $question,
        ]);
    }
}
