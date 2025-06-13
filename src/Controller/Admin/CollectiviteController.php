<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/collectivite', name: 'admin_collectivite_')]
class CollectiviteController extends AbstractController
{
    #[Route('', name: 'browse')]
    public function browse(): Response
    {
        return $this->render('admin/collectivite/browse.html.twig', []);
    }

    #[Route('/all', name: 'all')]
    public function allCollectivite(): Response
    {
        return $this->render('admin/collectivite/all.html.twig', [
        ]);
    }
}
