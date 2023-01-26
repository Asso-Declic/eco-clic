<?php

    include "../Autoload.php";

    $data = DbUtilisateur::getUserProgression($_GET['CollectiviteId']);
    $results = ["data" => $data ];
    echo AjaxHelper::ToJson($results);
?>