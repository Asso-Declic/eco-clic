<?php

    include "../Autoload.php";

    $data = DbTheme::getThemes();
    $results = ["data" => $data ];
    echo AjaxHelper::ToJson($results);
?>