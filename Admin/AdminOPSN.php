<?php
include "../Autoload.php";

include "Common.php";

if (SessionHelper::GetCurrentUserAdministrateur()->SuperAdmin == 0) {
    // header('Location: OPSN.php?Id='.SessionHelper::GetCurrentUserAdministrateur()->OPSNId);
    header('Location: collectivite.php');
    exit;
}

$selectedNav = "AdminOPSN";
// $Arianne = [];
// $fil1 = new Arianne;
// $fil1->Libelle = "OPSN";
// $fil1->Icone = "opsn";
// $fil1->Lien = "./AdminOPSN.php";
// $Arianne[] = $fil1;

require "header.php";

?>

<title>L'éco-clic Admin - OPSN</title>

<div class="col-md-12">
    <div class="info" style="height: 130px; margin-top: 30px;">
        <div id="traitVertical" class="col-3">
            <h5 id="OPSNName"></h5>
            <h2 id="titreColOPSN">OPSN</h2>
        </div>
        
    </div>
</div>

<!-- Modal ajout OPSN -->
<div class='modal fade' id='AjoutOPSN' tabindex='-1' aria-labelledby='AjoutOPSNLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='AjoutOPSNLabel'>Ajouter un OPSN</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <form class='modal-body' action="../AjaxLoader/InsertOPSN.php">
                <div id="form-ajout"></div>
            </form>
        </div>
    </div>
</div>

<!-- Modal ajout utilisateurs -->
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
                <form action="../AjaxLoader/InsertUtilisateursOPSN2.php">
                    <div id="form-modale-ajout"></div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="d-flex justify-content-end col-12">
    <button id="add" data-toggle='modal' data-target='#AjoutOPSN'><i class="fas fa-plus-circle"></i> OPSN</button>
</div>

<div class="traitHorizontal"></div>

<div class="px-3" style="margin-top: 11px;">
    <div id="gridContainer"></div>
</div>

<script src="./js/AdminOPSN.js"></script>