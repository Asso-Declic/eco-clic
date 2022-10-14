<?php 
include "../Autoload.php";

$data = DbAPI::GetInformationBySiret($_GET['Siret']);

echo AjaxHelper::ToJson($data);

?>