<?php

    include "../Autoload.php";

    $data = DbReponse::GetReponseUser($_GET['IdQuestion'], $_GET['IdUtilisateur']);
    $results = ["data" => $data ];
    echo AjaxHelper::ToJson($results);
?>