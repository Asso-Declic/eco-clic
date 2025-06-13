<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PatchNoteType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\PatchNote;
use App\Repository\PatchNoteRepository;

#[Route('/admin/patchNote', name: 'admin_patchNote_')]
class PatchNoteController extends AbstractController
{
    #[Route('', name: 'browse')]
    public function browse(Request $request, PatchNoteRepository $patchNoteRepository): Response
    {
        $patchNote = new PatchNote();

        $form = $this->createForm(PatchNoteType::class, $patchNote);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $patchNoteRepository->insert($patchNote);
            return $this->json('', 204);
        }

        return $this->render('admin/patchNote/browse.html.twig', [
            'form' => $form->createView()
        ]);
    }
}