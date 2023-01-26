<?php
include "../Autoload.php";

$data = DbOPSN::GetOPSN($_GET['Id']);

echo AjaxHelper::ToJson($data);