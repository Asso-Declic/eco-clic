<?php
include "../Autoload.php";




$selectedNav = "AdminOPSN";
$Arianne = [];
$fil1 = new Arianne;
$fil1->Libelle = "OPSN";
$fil1->Icone = "opsn";
$fil1->Lien = "./AdminOPSN.php";
$Arianne[] = $fil1;

$fil2 = new Arianne;
$fil2->Libelle = "Modification OPSN";
$fil2->Icone = null;
$fil2->Lien = "./modifOPSN.php?Id=" . $_GET["Id"];
$Arianne[] = $fil2;
require "header.php";
if (SessionHelper::GetCurrentUserAdministrateur()->SuperAdmin == 0) {
    header('Location: ./OPSN.php');
    exit;
}
?>

<div class="mt-5 px-3">
    <h3 class="vertNumeriscore">Modification OPSN</h3>
    <form class='modal-body' action="../AjaxLoader/InsertOPSN.php">
        <div id="form-modif"></div>
        <div id="filoe_uploader"></div>
    </form>
</div>

<script src="./js/modifOPSN.js"></script>