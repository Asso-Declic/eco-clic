<?php

include "../Autoload.php";

include "Common.php";

if (SessionHelper::GetCurrentUserAdministrateur()->SuperAdmin == 0) {
    header('Location: ./utilisateursOPSN.php');
    exit;
}

$selectedNav= "utilisateurs";
// $Arianne = [];
// $fil1 = New Arianne;
// $fil1->Libelle = "Utilisateurs";
// $fil1->Icone = "utilisateurs";
// $fil1->Lien = "./utilisateurs.php";
// $Arianne[] = $fil1;

require "header.php";

?>
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<!-- <link rel="stylesheet" href="./devExtreme/css/dx.light.css" /> -->

<title>L'éco-clic Admin - Utilisateurs</title>

<div class="col-md-12">
    <div class="info" style="height: 130px; margin-top: 30px;">
        <div id="traitVertical" class="col-3">
            <h5 id="OPSNName"></h5>
            <h2 id="titreColOPSN">Utilisateurs</h2>
        </div>
        
    </div>
</div>

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
    <button id="add" ><i class="fas fa-plus-circle"></i> Ajouter un utilisateur</button>
</div>

<div class="traitHorizontal"></div>

<div class="px-3" id="gridContainer" style="margin-top: 11px;"></div>

<script src="./js/utilisateurs.js"></script>