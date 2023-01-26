<?php 
include "../Autoload.php";

if ($_GET['Siret'] != 00000000000000) {
    $data = DbAPI::GetInformationBySiret($_GET['Siret']);
    echo AjaxHelper::ToJson($data);
} else {
    echo null;
}




?>