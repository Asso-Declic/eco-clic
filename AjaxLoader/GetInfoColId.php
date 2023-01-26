<?php 
include "../Autoload.php";

$data = DbCollectivite::GetInfoColId($_GET['Id']);

echo AjaxHelper::ToJson($data);

?>