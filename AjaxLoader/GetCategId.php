<?php

    include "../Autoload.php";

    $data = DbCategorie::GetCategId($_GET['CategorieId']);
    $results = ["data" => $data ];
    echo AjaxHelper::ToJson($results);
?>