<?php
include "../Autoload.php";

$data = DbOPSN::GetOPSNS();

echo AjaxHelper::ToJson($data);