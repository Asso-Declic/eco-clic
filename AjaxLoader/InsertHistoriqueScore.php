<?php

    include "../Autoload.php";

    $CollectiviteId = json_decode($_POST["CollectiviteId"]);

    $total = DbQuestion::GetQuestionTotal();

    $score = DbUtilisateur::getUserScore($CollectiviteId);
    if ($total == $score[0]->nb) {
        $score = floor($score[0]->score * 100 / $score[0]->nb);
    
        $result = DbCollectivite::InsertHistoriqueScore($CollectiviteId, $score);
        
    }
    
    echo 1;
?>