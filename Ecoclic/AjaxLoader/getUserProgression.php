<?php

    include "../Autoload.php";

    $data = DbUtilisateur::getUserProgression($_GET['userId']);
    $results = ["data" => $data ];
    echo AjaxHelper::ToJson($results);
?>