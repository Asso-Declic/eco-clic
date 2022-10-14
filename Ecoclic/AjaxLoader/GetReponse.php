<?php

    include "../Autoload.php";

    $data = DbReponse::GetReponse($_GET['IdQuestion']);
    $results = ["data" => $data ];
    echo AjaxHelper::ToJson($results);
?>