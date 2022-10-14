<?php

    include "../Autoload.php";

    $data = DbQuestion::GetQuestionCateg($_GET['CategorieId']);
    $results = ["data" => $data ];
    echo AjaxHelper::ToJson($results);
?>