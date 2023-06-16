<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/opsn', name: 'admin_opsn_')]
class OPSNController extends AbstractController
{
    #[Route('', name: 'browse')]
    public function browse(): Response
    {
        return $this->render('admin/opsn/browse.html.twig', [
            'controller_name' => 'OPSNController',
        ]);
    }
}
