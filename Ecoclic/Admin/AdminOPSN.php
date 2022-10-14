<?php
include "../Autoload.php";



$selectedNav = "AdminOPSN";
$Arianne = [];
$fil1 = new Arianne;
$fil1->Libelle = "OPSN";
$fil1->Icone = "opsn";
$fil1->Lien = "./AdminOPSN.php";
$Arianne[] = $fil1;

require "header.php";

if (SessionHelper::GetCurrentUserAdministrateur()->SuperAdmin == 0) {
    header('Location: ./OPSN.php?Id='.SessionHelper::GetCurrentUserAdministrateur()->OPSNId);
    exit;
}

?>

<!-- Modal -->
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


<div class="d-flex justify-content-end col-12">
    <button id="add" class="bouton-numeriscore px-5 py-3 rounded text-white" data-toggle='modal' data-target='#AjoutOPSN'>OPSN <i class="fas fa-plus-circle"></i></button>
</div>

<div class="mt-5 px-3">
    <h3 class="vertNumeriscore">OPSN</h3>
    <div id="gridContainer"></div>
</div>

<script src="./js/AdminOPSN.js"></script>