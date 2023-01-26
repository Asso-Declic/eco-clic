<?php

include "../Autoload.php";

$data = DbRecommandation::GetRecomandationFiltres();
$results = ["data" => $data ];


echo AjaxHelper::ToJson($results);
?>