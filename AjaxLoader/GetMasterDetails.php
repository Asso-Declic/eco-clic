<?php
include "../Autoload.php";

$data = DbOPSN::GetOPSNSDepartements($_GET['Id']);

echo AjaxHelper::ToJson($data);