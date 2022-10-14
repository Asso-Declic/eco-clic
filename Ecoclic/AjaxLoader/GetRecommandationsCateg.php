<?php

include "../Autoload.php";

    $data = DbRecommandation::GetRecommandationsCateg($_GET['CategorieId']);

    $results = ["data" => $data ];
    echo AjaxHelper::ToJson($results);
?>