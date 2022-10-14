<?php

    include "../Autoload.php";

    $data = DbUtilisateur::getUserProgressionCateg($_GET['userId'], $_GET['categId']);
    $results = ["data" => $data ];
    echo AjaxHelper::ToJson($results);
?>