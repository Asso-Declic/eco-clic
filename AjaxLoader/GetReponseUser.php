<?php

    include "../Autoload.php";

    $data = DbReponse::GetReponseUser($_GET['IdQuestion'], $_GET['CollectiviteId']);
    $results = ["data" => $data ];
    echo AjaxHelper::ToJson($results);
?>