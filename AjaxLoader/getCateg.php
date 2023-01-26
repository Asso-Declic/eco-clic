<?php

    include "../Autoload.php";

    $data = DbCategorie::getCategories();
    $results = ["data" => $data ];
    echo AjaxHelper::ToJson($results);
?>