<?php
include "../Autoload.php";

if ($_GET['OPSNId'] == "404") {
    $data = DbCollectivite::GetCollectivitesInfos();
} else {
    $data = DbCollectivite::GetCollectivitesInfosOPSN($_GET['OPSNId']);
}

$i = 0;
$moyenne = 0;

foreach ($data as $collectivite) {
    $CollectiviteId = $collectivite->Id;
    $CodeRegion = DbCollectivite::GetCodeRegionAndDepartementByCollectiviteId($CollectiviteId)[0]["CodeRegion"];
    $DepartementCode = DbCollectivite::GetCodeRegionAndDepartementByCollectiviteId($CollectiviteId)[0]["DepartementCode"];  
    $Total = DbCollectivite::GetScoreTotal($DepartementCode, $CodeRegion, $CollectiviteId);
    $avance = DbCollectivite::GetAvance($CollectiviteId);
    $detailAvance = DbCollectivite::GetDetailAvance($CollectiviteId);
    $score = $Total[0]->VotreScore;
    $ScoreDepartemental = $Total[0]->ScoreDepartemental;
    $ScoreRegional = $Total[0]->ScoreRegional;
    if ($score == null) {
        $data[$i]->Score = "N/A";
    } elseif ($score>80) {
        $data[$i]->Score = "A";
    } elseif ($score>60 && $score<80) {
        $data[$i]->Score = "B";
    } elseif ($score>40 && $score<60) {
        $data[$i]->Score = "C";
    } elseif ($score>20 && $score<40) {
        $data[$i]->Score = "D";
    } elseif ($score<20) {
        $data[$i]->Score = "E";
    }
    
    $data[$i]->Avancee = round($avance)." %";
    $data[$i]->detailAvance = $detailAvance;
    $data[$i]->ScoreDepartemental = $ScoreDepartemental;
    $data[$i]->ScoreRegional = $ScoreRegional;
    $moyenne += $score;

    $i++;
}

$moyenne = floor($moyenne/$i);
$nb = $i;

$results = ["data" => $data, "moyenne" => $moyenne, "nb" => $nb];

echo AjaxHelper::ToJson($results);