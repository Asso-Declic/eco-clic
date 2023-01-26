<?php

    include "../Autoload.php";

    $data = DbUtilisateur::getUserProgressionCateg($_GET['CollectiviteId'], $_GET['categId']);
    $results = ["data" => $data ];
    echo AjaxHelper::ToJson($results);
?>