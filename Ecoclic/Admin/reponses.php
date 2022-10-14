<?php
include "../Autoload.php";
$selectedNav= "themes";

if (!isset($_SESSION['Version'])) {
    header('Location: ./themes.php');
    exit();
}

if (SessionHelper::GetCurrentUserAdministrateur()->SuperAdmin == 0) {
    header('Location: ./utilisateursOPSN.php');
    exit;
}

$catId = DbTheme::GetCatIdByQuestionId($_GET['id'], $_SESSION['Version']);
$themeId = DbTheme::GetThemeIdByCatId($catId, $_SESSION['Version']);

$Arianne = [];
$fil1 = New Arianne;
$fil1->Libelle = "Thèmes";
$fil1->Icone = "themes";
$fil1->Lien = "./themes.php";
$Arianne[] = $fil1;

$fil2 = New Arianne;
$fil2->Libelle = "Catégories";
$fil2->Icone = null;
$fil2->Lien = "./categories.php?id=".$themeId;
$Arianne[] = $fil2;

$fil3 = New Arianne;
$fil3->Libelle = "Questions";
$fil3->Icone = null;
$fil3->Lien = "./questions.php?id=".$catId;
$Arianne[] = $fil3;

$fil4 = New Arianne;
$fil4->Libelle = "Réponses";
$fil4->Icone = null;
$fil4->Lien = "./reponses.php?id=".$_GET['id'];
$Arianne[] = $fil4;
require "header.php";

?>
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<!-- <link rel="stylesheet" href="./devExtreme/css/dx.light.css" /> -->

<div class="modal" id="modale" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Insérer une nouvelle ligne</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../AjaxLoader/UpdateReponses.php">
                    <div id="form-modale"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modale_modifier" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier une ligne</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../AjaxLoader/UpdateReponses.php" id="form-modif">
                    <div id="form-modale-modifier"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="confirm"></div>

<form action="../AjaxLoader/UpdateQuestions.php" id="form-container">
    <div class="mt-5 px-3" id="formulaire"></div>
</form>

<div class="d-flex justify-content-end col-12">
    <button id="add" class="bouton-numeriscore px-5 py-3 rounded text-white">Réponse <i class="fas fa-plus-circle"></i></button>
</div>

<div class="mt-5 px-3">
    <h3 class="vertNumeriscore">Réponses</h3>
    <div id="gridContainer"></div>
</div>

<script src="./js/reponses.js"></script>
