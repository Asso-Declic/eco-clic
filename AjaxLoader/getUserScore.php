<?php

    include "../Autoload.php";

    $data = DbUtilisateur::getUserScore($_GET['CollectiviteId']);
    $results = ["data" => $data ];
    echo AjaxHelper::ToJson($results);
?>