<?php

    include "../Autoload.php";

    $data = DbUtilisateur::getUserScore($_GET['userId']);
    $results = ["data" => $data ];
    echo AjaxHelper::ToJson($results);
?>