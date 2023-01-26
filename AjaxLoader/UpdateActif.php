<?php

include "../Autoload.php";

$userId = $_POST['utilisateurId'];
$actif = DbUtilisateur::GetUtilisateur($userId)->Actif;
if ($actif == 1) {
    $actif = 0;
}else {
    $actif = 1;
}
// var_dump($userId, $actif);
echo DbUtilisateur::UpdateActif($userId, $actif);

?>