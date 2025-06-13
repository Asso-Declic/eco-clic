<?php

namespace App\Controller;

use App\Entity\PatchNote;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PatchNoteRepository;

#[Route('/patchNote', name: 'patchNote_')]
class PatchNoteController extends AbstractController
{
    #[Route('', name: 'browse', methods: ['GET'])]
    public function browse(PatchNoteRepository $patchNoteRepository): Response
    {
        return $this->render('patchNote/browse.html.twig', [
            'patchNote' => $patchNoteRepository->findOneBy([], ['id' => 'DESC']), 200, [],
        ]);
    }
}
