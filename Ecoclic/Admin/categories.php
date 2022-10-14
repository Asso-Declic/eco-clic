<?php
include "../Autoload.php";

if (!isset($_SESSION['Version'])) {
    header('Location: ./themes.php');
    exit();
}

if (SessionHelper::GetCurrentUserAdministrateur()->SuperAdmin == 0) {
    header('Location: ./utilisateursOPSN.php');
    exit;
}

$selectedNav = "themes";
$Arianne = [];
$fil1 = new Arianne;
$fil1->Libelle = "Thèmes";
$fil1->Icone = "themes";
$fil1->Lien = "./themes.php";
$Arianne[] = $fil1;

$fil2 = new Arianne;
$fil2->Libelle = "Catégories";
$fil2->Icone = null;
$fil2->Lien = "./categories.php?id=" . $_GET['id'];
$Arianne[] = $fil2;
require "header.php";

?>
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<!-- <link rel="stylesheet" href="./devExtreme/css/dx.light.css" /> -->

<div class="modal" id="modale" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Insérer une nouvelle ligne</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../AjaxLoader/UpdateCategories.php">
                    <div id="form-modale"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="confirm"></div>

<form action="../AjaxLoader/UpdateThemes.php" id="form-container">
    <div class="mt-5 px-3" id="formulaire"></div>
</form>

<div class="d-flex justify-content-end col-12">
    <button id="add" class="bouton-numeriscore px-5 py-3 rounded text-white">Catégorie <i class="fas fa-plus-circle"></i></button>
</div>

<div class="mt-5 px-3">
    <h3 class="vertNumeriscore">Catégories</h3>
    <div id="gridContainer"></div>
</div>

<script src="./js/categories.js"></script>