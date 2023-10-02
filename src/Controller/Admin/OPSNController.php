<?php

namespace App\Controller\Admin;

use App\Entity\Collectivite;
use App\Entity\CollectiviteType;
use App\Entity\OPSN;
use App\Form\CollectiviteFormType;
use App\Form\OPSNType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

#[Route('/admin/opsn', name: 'admin_opsn_')]
class OPSNController extends AbstractController
{
    #[Route('', name: 'browse')]
    public function browse(): Response
    {
        return $this->render('admin/opsn/browse.html.twig', [
        ]);
    }

    #[Route('/add', name: 'add', methods: ['POST'])]
    public function add(EntityManagerInterface $em, Request $request): Response
    {
        $opsn = new OPSN();
        $form = $this->createForm(OPSNType::class, $opsn, ['csrf_protection' => false]);

        $formData = $request->request->all('opsn');
        $formData['departements'] = explode(',', $formData['departements']);
        $form->submit($formData);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($opsn);
            $em->flush();
        }
        
        return $this->redirectToRoute('admin_opsn_browse');
    }

    #[Route('/edit/{id}', name: 'edit')]
    public function edit(EntityManagerInterface $em, NormalizerInterface $normalizerInterface, OPSN $opsn, Request $request)
    {
        $form = $this->createForm(OPSNType::class, $opsn, ['csrf_protection' => false]);

        $formData = $request->request->all('opsn');
        if (isset($formData['departements'])) {
            $formData['departements'] = explode(',', $formData['departements']);
            $form->submit($formData);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            // $this->addFlash('success', 'L\'OPSN a bien été ajoutée.');
        }

        $opsnArray = $normalizerInterface->normalize($opsn, null, ['groups' => 'opsn_browse']);
        return $this->render('admin/opsn/edit.html.twig', [
            'opsn' => $opsnArray,
        ]);
    }

    #[Route('/rattachement', name: 'collectivite_link')]
    public function collectiviteLink(): Response
    {
        return $this->render('admin/opsn/collectivite_link.html.twig', [
        ]);
    }
}
