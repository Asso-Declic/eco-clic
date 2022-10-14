<?php
include "./Autoload.php";
?>

<?php include "Common.php"?>

<?php
    if(SessionHelper::GetCurrentUser()->Admin == 0){
        header("Location: ./accueil.php");
    }
?>


<!-- Header  -->
<?php require "header.php"?>

<!-- Sidebar  -->
<?php require "menu.php"?>

<!-- Page Content  -->
<div id="content" class="container-fluid">

    <!-- Barre de recherche  -->
    <?php require "recherche.php"?>

    <?php
        if(SessionHelper::GetCurrentUser()->SuperAdmin == 1){
    ?>
        <div class="col-12 fil-ariane py-2 px-4">
            <img src="./img/parametres.svg" alt=""> 
            <a class="fil-ariane" href="./parametresAdmin.php">Paramètres administrateur</a>
            <i class="fas fa-chevron-right" style="color:#08433D"></i>
            <img src="./img/parametres.svg" alt="">
            <a class="fil-ariane" href="./parametres.php">Gestion utilisateur</a>
        </div>
    <?php
        } else {
    ?>
        <div class="col-12 fil-ariane py-2 px-4">
            <img src="./img/parametres.svg" alt=""> 
            <a class="fil-ariane" href="./parametres.php">Paramètres</a>
        </div>
    <?php
        }
    ?>

    

    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
    <div class="modal" id="modaleAddUser" tabindex="-1">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title sous-titre">Ajouter un utilisateur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./AjaxLoader/addUserParametres.php">
                    <span class="chapms-obligatoires"><span class="dx-field-item-required-mark">*</span> Champs Obligatoires</span>
                        <div id="form-modaleAddUser"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modaleModifUser" tabindex="-1">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title sous-titre">Modifier un utilisateur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./AjaxLoader/UpdateUtilisateursCollectivite.php" id="s69420">
                    <span class="chapms-obligatoires"><span class="dx-field-item-required-mark">*</span> Champs Obligatoires</span>
                        <div id="form-modaleModifUser"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="pt-5 d-flex col-12 justify-content-between">
        <span class="sous-titre">gestion utilisateur</span>
        <button class="bouton-ecoclic px-md-5 py-md-3 rounded text-white" id="AddUser"><i class="fas fa-user pr-2"></i>Ajouter un utilisateur</button>
    </div>

    <div class="mt-5 px-3">
        <div id="gridContainer"></div>
    </div>

    <script src="./js/parametres.js"></script>