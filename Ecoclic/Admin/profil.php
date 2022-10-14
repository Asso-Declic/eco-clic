<?php
include "../Autoload.php";
$selectedNav = "parametres";

$Arianne = [];
$fil1 = new Arianne;
$fil1->Libelle = "Profil";
$fil1->Icone = "parametres";
$fil1->Lien = "./profil.php";
$Arianne[] = $fil1;
include "header.php";

?>

<div class="pt-5 d-flex col-12 justify-content-between">
    <span class="sous-titre">Modifer mon profil</span>
</div>

<div class="mt-5 px-3">
    <form action="../AjaxLoader/UpdateAdminProfil.php" id="formulaire">
        <div id="form_profil"></div>
    </form>
</div>

<script src="./js/profil.js"></script>