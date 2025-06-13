<?php

namespace App\Controller\Api;

use App\Entity\Category;
use App\Service\ScoreManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/scores', name: 'api_score_')]
class ScoreController extends AbstractController
{
    /**
     * Fournit le score global de la collectivité
     * Si aucun score n'est trouvé, tente de le calculer et l'enregistrer
     * Si la progression est incomplète, renvoie null
     *
     * @param ScoreManager $scoreManager
     */
    #[Route('', name: 'read', methods: ['GET'])]
    public function read(ScoreManager $scoreManager): Response
    {
        $collectivite = $this->getUser()->getCollectivite();
        return $this->json($scoreManager->getCurrent($collectivite), 200, [], ['groups' => 'score']);
    }

    #[Route('/{id}', name: 'read_for_category', methods: ['GET'], requirements: ['id' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$'])]
    public function readForCategory(Category $category, ScoreManager $scoreManager): Response
    {
        $score = $scoreManager->countForCategory($category, $this->getUser()->getCollectivite());
        // MySQL, avec PHP, retourne une string pour une fonction SUM()
        // Il faut renvoyer un int pour être propre et Doctrine n'aide pas beaucoup pour CAST en INT
        // On utilise un pansement ici, mais il faudrait trouver une solution plus propre (soit on est sale en JS, soit on est sale en PHP, il fallait choisir)
        $score['score'] = (int) $score['score'];

        return $this->json($score, 200, [], ['groups' => 'score']);
    }

    /**
     * Retoune l'objet Score ou null si la progression n'est pas complète
     *
     * @param ScoreManager $scoreManager
     */
    #[Route('', name: 'add', methods: ['POST'])]
    public function add(ScoreManager $scoreManager): Response
    {
        $collectivite = $this->getUser()->getCollectivite();
        $score = $scoreManager->createAndSave($collectivite);

        if ($score == null) {
            return $this->json(['data' => null, 'message' => 'La progression n\'est pas complète. Le score ne peut être ajouté'], 400);
        }
        return $this->json(['data' => $score], 201, [], ['groups' => 'score']);
    }

    /**
     * Retourne le score moyen de toutes les collectivités de l'OPSN
     *
     * @param ScoreManager $scoreManager
     */
    #[Route('/by-opsn', name: 'browse_by_opsn', methods: ['GET'])]
    public function browseByOpsn(ScoreManager $scoreManager): Response
    {
        $opsn = $this->getUser()->getOpsn();
        $score = $scoreManager->getOpsnAverage($opsn);
        return $this->json($score);
    }

    #[Route("/list", name: "list", methods: ['GET'])]
    public function list(ScoreManager $scoreManager)
    {
        $collectivite = $this->getUser()->getCollectivite();
        $scores = $scoreManager->getList($collectivite);
        return $this->json($scores, 200, [], ['groups' => 'score']);
    }
}
