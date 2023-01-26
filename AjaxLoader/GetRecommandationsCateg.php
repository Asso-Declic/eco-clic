<?php

include "../Autoload.php";

    $data = DbRecommandation::GetRecommandationsCateg($_GET['CategorieId'], $_GET['CollectiviteId']);

    $results = ["data" => $data ];
    echo AjaxHelper::ToJson($results);
?>