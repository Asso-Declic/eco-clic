<?php

    include "../Autoload.php";

    $data = DbRecommandation::GetRecommandations();
    $results = ["data" => $data ];
    echo AjaxHelper::ToJson($results);
?>