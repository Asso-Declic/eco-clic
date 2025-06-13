<?php

namespace App\Controller\Api;

use App\Entity\PatchNote;
use App\Repository\PatchNoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Form\PatchNoteType;

#[Route('/api/patch_note', name: 'api_patch_note_')]
class PatchNoteController extends AbstractController
{
    #[Route('', name: 'browse', methods: ['GET'])]
    public function browse(PatchNoteRepository $PatchNoteRepository): Response
    {        
        return $this->json($PatchNoteRepository->findOneBy([], ['id' => 'DESC']), 200, []);
    }

    #[Route('/all', name: 'all', methods: ['GET'])]
    public function all(PatchNoteRepository $PatchNoteRepository): Response
    {        
        return $this->json($PatchNoteRepository->findBy([], ['id' => 'DESC']));
    }
}
