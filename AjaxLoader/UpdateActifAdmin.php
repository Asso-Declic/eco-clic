<?php

include "../Autoload.php";

$userId = $_POST['utilisateurId'];
$actif = DbAdministrateur::GetUtilisateur($userId)->Actif;

if ($actif == 1) {
    $actif = 0;
}else {
    $actif = 1;
}
DbAdministrateur::UpdateActif($userId, $actif);

?>