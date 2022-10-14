<?php

    include "../Autoload.php";

    $data = DbCategorie::getCategorieInfo();
    $results = ["data" => $data ];
    echo AjaxHelper::ToJson($results);
?>