<?php

namespace App\Controller\Api;

use App\Entity\Category;
use App\Entity\Collectivite;
use App\Entity\Question;
use App\Repository\CategoryRepository;
use App\Repository\RecommandationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

#[Route('/api/recommendations', name: 'api_recommandation_')]
class RecommandationController extends AbstractController
{
    #[Route('', name: 'browse', methods: ['GET'])]
    public function browse(RecommandationRepository $recommandationRepository): JsonResponse
    {
        $recommandations = $recommandationRepository->findAllForCollectivite($this->getUser()->getCollectivite());
        return $this->json($recommandations);
    }

    /**
     * Fournit les recommandations par catégorie pour une collectivité
     *
     * @param Category $category
     * @param RecommandationRepository $recommandationRepository
     * @return JsonResponse
     */
    #[Route('/by-category/{id}', name: 'by_category', requirements: ['id' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$'])]
    public function byCategory(Category $category, RecommandationRepository $recommandationRepository): JsonResponse
    {
        $recommandations = $recommandationRepository->findByCategory($category, $this->getUser()->getCollectivite());
        return $this->json($recommandations);
    }

    /**
     * Fournit les recommandations par catégorie pour une collectivité
     * Doit fournir la liste des catégories à chaque fois
     *
     * @return JsonResponse
     */
    #[Route('/by-collectivite/{id}', name: 'by_collectivite', requirements: ['id' => '^([0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}|404|403)$'])]
    public function byCollectivite(CategoryRepository $categoryRepository, Collectivite $collectivite, RecommandationRepository $recommandationRepository): JsonResponse
    {
        $recommandations = $recommandationRepository->countTotalsPerCategories($collectivite);
        $categories = $categoryRepository->findBy([], ['sortOrder' => 'ASC']);

        foreach ($categories as $category) {
            $found = false;
            foreach ($recommandations as $recommandation) {
                if ($recommandation['id'] === $category->getId()) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $recommandations[] = [
                    'id' => $category->getId(),
                    'nb_recommandation' => 0,
                    'ordre' => $category->getsortOrder(),
                ];
            }
        }

        $columns  = array_column($recommandations, 'ordre');
        array_multisort($columns, SORT_ASC, $recommandations);

        return $this->json($recommandations);
    }

    #[Route('/perso/by-category/{id}', name: 'custom_inputs', requirements: ['id' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$'])]
    public function persoByCategory(Category $category, RecommandationRepository $recommandationRepository): JsonResponse
    {
        $questions = $recommandationRepository->findRecommandationsPersoByCategory($category);
        return $this->json($questions, 200, [], ['groups' => ['question', 'recommandation_perso']]);
    }
    
    #[Route('/answers/{question}/{collectivite}', name: 'answers_by_question', requirements: ['question' => '^[0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}$'])]
    public function answersByQuestion(Collectivite $collectivite, Question $question, RecommandationRepository $recommandationRepository): JsonResponse
    {
        $questions = $recommandationRepository->findAnswersByQuestion($question, $collectivite);
        return $this->json($questions, 200, [], ['groups' => ['question', 'recommandation_perso']]);
    }

    #[Route('/filters', name: 'filters')]
    public function filters(RecommandationRepository $recommandationRepository): JsonResponse
    {
        $filters = $recommandationRepository->findFilters($this->getUser()->getCollectivite());
        return $this->json(['data' => $filters]);
    }

    #[Route('/non-active', name: 'non_active', methods: ['GET'])]
    public function nonActive(RecommandationRepository $recommandationRepository): JsonResponse
    {
        $recommandations = $recommandationRepository->findNonActive($this->getUser()->getCollectivite());
        return $this->json($recommandations);
    }

    #[Route('/totals-per-categories', name: 'totals_per_categories')]
    public function totalsPerCategories(CategoryRepository $categoryRepository, RecommandationRepository $recommandationRepository): JsonResponse
    {
        $totals = $recommandationRepository->countTotalsPerCategories($this->getUser()->getCollectivite());
        $categories = $categoryRepository->findBy([], ['sortOrder' => 'ASC']);

        foreach ($categories as $category) {
            $found = false;
            foreach ($totals as $recommandation) {
                if ($recommandation['id'] === $category->getId()) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $totals[] = [
                    'id' => $category->getId(),
                    'nb_recommandation' => 0,
                    'ordre' => $category->getsortOrder(),
                ];
            }
        }

        $columns  = array_column($totals, 'ordre');
        array_multisort($columns, SORT_ASC, $totals);

        return $this->json(['data' => $totals]);
    }

    #[Route('/download/{id}/{extract}', name: 'download', requirements: ['id' => '^([0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}|404|403)$'])]
    public function downloadReco(Collectivite $collectivite, bool $extract, RecommandationRepository $recommandationRepository): Response
    {
        $recommandations = $recommandationRepository->downloadRecommandations($collectivite);

        if ($extract) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // === TITRE ===
            $titre = $collectivite->getName() . ' - ' . date('d/m/Y');
            //$sheet->mergeCells('A1:E1'); // Adapte la plage selon ton nombre de colonnes
            $sheet->setCellValue('B1', $titre);
            $sheet->getStyle('B1')->getFont()->setSize(16)->setBold(true);
            $sheet->getStyle('B1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            // === IMAGE ===
            $imagePath = __DIR__ . '/../../../public/img/logoEcoclic.png';
            if (file_exists($imagePath)) {
                $drawing = new Drawing();
                $drawing->setPath($imagePath);
                $drawing->setCoordinates('A1'); // positionne à droite
                $drawing->setHeight(60);
                $drawing->setWorksheet($sheet);
            }

            // === EN-TÊTES ===
            $headers = array_keys($recommandations[0] ?? []);
            $sheet->fromArray($headers, null, 'A4');

            // Style des en-têtes
            $headerRange = 'A4:' . chr(65 + count($headers) - 1) . '4';
            $sheet->getStyle($headerRange)->getFont()->setBold(true);
            $sheet->getStyle($headerRange)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('D9E1F2');
            $sheet->getStyle($headerRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle($headerRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            // === DONNÉES ===
            $row = 5;
            foreach ($recommandations as $record) {
                $sheet->fromArray(array_values($record), null, 'A' . $row);
                $dataRange = 'A' . $row . ':' . chr(65 + count($record) - 1) . $row;
                $sheet->getStyle($dataRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                $row++;
            }

            // === AUTO-AJUSTEMENT DES COLONNES ===
            $colCount = count($headers);
            for ($col = 0; $col < $colCount; $col++) {
                $colLetter = chr(65 + $col);
                $sheet->getColumnDimension($colLetter)->setAutoSize(true);
            }

            // === AJOUT DU FILTRE ===
            $lastColumn = chr(65 + $colCount - 1);
            $lastRow = $row - 1; // ligne de la dernière donnée
            $sheet->setAutoFilter("A4:{$lastColumn}{$lastRow}");

            // === EXPORT ===
            $writer = new Xlsx($spreadsheet);
            $filename = $collectivite->getName() . '-' . date('d-m-Y') . '.xlsx';

            $response = new Response();
            $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            $response->headers->set('Content-Disposition', 'attachment;filename="' . $filename . '"');
            $response->headers->set('Cache-Control', 'max-age=0');

            ob_start();
            $writer->save('php://output');
            $response->setContent(ob_get_clean());

            return $response;
        }

        return $this->json(['data' => $recommandations]);
    }

    #[Route('/totals-by-collectivite/{id}', name: 'totals_by_collectivite', requirements: ['id' => '^([0-9a-fA-F]{8}-([0-9a-fA-F]{4}-){3}[0-9a-fA-F]{12}|404|403)$'])]
    public function totalsRecoByCollectivite(Collectivite $collectivite, RecommandationRepository $recommandationRepository): JsonResponse
    {
        $recommandations = $recommandationRepository->totalsRecommandationsByCollectivite($collectivite);

        return $this->json(['data' => $recommandations]);
    }
}


