<?php
include "../Autoload.php";


$actif = DbOPSN::GetOPSN($_GET['Id'])->Actif;

if ($actif == 1) {
    $actif = 0;
}else {
    $actif = 1;
}

$data = DbOPSN::UpdateActifOPSN($_GET['Id'], $actif);

echo $data;