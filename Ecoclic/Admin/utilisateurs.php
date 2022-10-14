<?php

include "../Autoload.php";

if (SessionHelper::GetCurrentUserAdministrateur()->SuperAdmin == 0) {
    header('Location: ./utilisateursOPSN.php');
    exit;
}

$selectedNav= "utilisateurs";
$Arianne = [];
$fil1 = New Arianne;
$fil1->Libelle = "Utilisateurs";
$fil1->Icone = "utilisateurs";
$fil1->Lien = "./utilisateurs.php";
$Arianne[] = $fil1;

require "header.php";


?>
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<!-- <link rel="stylesheet" href="./devExtreme/css/dx.light.css" /> -->

<!-- Modal -->
<div class="modal fade" id="ModaleUtilisateurs" tabindex="-1" aria-labelledby="ModaleUtilisateursLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModaleUtilisateursLabel">Modifier un utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../AjaxLoader/UpdateUtilisateurs.php" id="s69420">
                    <div id="form-modale"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModaleAjoutUtilisateurs" tabindex="-1" aria-labelledby="ModaleAjoutUtilisateursLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModaleAjoutUtilisateursLabel">Ajouter un utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../AjaxLoader/InsertUtilisateurs.php">
                    <div id="form-modale-ajout"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end col-12">
    <button id="add" class="bouton-numeriscore px-5 py-3 rounded text-white">Utilisateur <i class="fas fa-plus-circle"></i></button>
</div>

<div class="mt-5 px-3" id="gridContainer"></div>

<script src="./js/utilisateurs.js"></script>