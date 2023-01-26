<?php
include "../Autoload.php";

$data = DbOPSN::GetDepartements();

echo AjaxHelper::ToJson($data);