<?php
include "../Autoload.php";

$selectedNav = "collectivite";
$Arianne = [];
$fil1 = new Arianne;
$fil1->Libelle = "Collectivités";
$fil1->Icone = "collectivite";
$fil1->Lien = "./collectivite.php";
$Arianne[] = $fil1;


require "header.php";

?>

<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<!-- <link rel="stylesheet" href="./devExtreme/css/dx.light.css" /> -->

<div class="mt-5 px-3">
    <h3 class="vertNumeriscore">Collectivités</h3>
    <div id="gridContainer"></div>
</div>

<script src="./js/collectivite.js"></script>