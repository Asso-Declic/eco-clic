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
<head>
    <title>L'éco-clic - Utilisateurs</title>
</head>
<!-- Sidebar  -->
<?php require "menu.php"?>

<!-- Page Content  -->
<div id="content" class="container-fluid">

    <!-- Barre de recherche  -->
    <?php require "recherche.php";?>


        <!-- <div class="col-12 fil-ariane py-2 px-4">
            <img src="./img/parametres.svg" alt="">
            <a class="fil-ariane" href="./parametres.php">Gestion des utilisateurs</a>
        </div> -->

        <div id="header">
            <div class="info line col-xl-12">
                <div id="titreCat" class="col-3">
                    <h2 id="col">
                        Gestion des utilisateurs
                    </h2>
                </div>
                <div class="traitVertical" style="height: auto;"></div>
                <!-- <div class="col-6" style="margin-right: 150px; height: 150px; overflow: hidden;"> -->
                <!-- </div> -->
            </div>
            <button id="AddUser"><i class="fa-solid fa-circle-plus"></i></i> Ajouter un utilisateur</button>
            <div class="traitHorizontal"></div>
        </div>
    

    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
    <div class="modal" id="modaleAddUser" tabindex="-1">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title sous-titre">AJOUT D'UN UTILISATEUR</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>
                <div class="modal-body">
                    <form action="./AjaxLoader/addUserParametres.php">
                    <!-- <span class="chapms-obligatoires"><span class="dx-field-item-required-mark">*</span> Champs Obligatoires</span> -->
                        <div id="form-modaleAddUser"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="confirm"></div>
    
    <div class="modal" id="modaleModifUser" tabindex="-1">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title sous-titre">MODIFICATION D'UN UTILISATEUR</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>
                <div class="modal-body">
                    <form action="./AjaxLoader/UpdateUtilisateursCollectivite.php" id="s69420">
                        <!-- <span class="chapms-obligatoires"><span class="dx-field-item-required-mark">*</span> Champs Obligatoires</span> -->
                        <div id="form-modaleModifUser"></div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="pt-5 d-flex col-12 justify-content-between">
        <button class="bouton-ecoclic px-md-5 py-md-3 rounded text-white" id="AddUser"><i class="fas fa-user pr-2"></i>Ajouter un utilisateur</button>
    </div> -->

    <div class="mt-5 px-3">
        <div id="gridContainer"></div>
    </div>

    <style>
        #AddUser {
            float: right;
            color: white;
            font-size: 16px;
            margin: 12px 24px 12px 0px;
            padding-inline: 24px;
            padding-block: 12px;
            border-radius: 10px;
            background-color: #00857A;
            border: solid 2px #00857A;
        }

        .line {
            height: 156px;
            margin: 4px 24px 0px 24px;
            border-radius: 5px;
        }

        #col {
            font-size: 36px;
            height: 100%;
        }

        @media (max-width: 1226px) {
            #col {
                font-size: 32px;
                height: 100%;
                padding: inherit;
            }
        }

        .traitHorizontal {
            border-bottom: solid 1px #08433D;
            margin-inline: 24px;
            margin-top: 79px;
        }

        .buttonForm .dx-button-content {
            width: 200px;
            height: 60px;
        }

        .dx-button-has-text .dx-button-content {
            width: 140px;
        }

        .dx-popup-bottom .dx-button {
            border-radius: 50px !important;
        }

        .dx-texteditor.dx-editor-outlined { 
            border-radius: 50px !important;
            height: 60px !important;
        }

        .buttonForm {
            border-radius: 50px !important;
        }

        .dx-popup-title, .dx-popup-bottom{
            background-color: #fff !important;
        }

        .dx-data-row:not(.dx-row-alt) > td {
            background-color: #fff !important;
        }

        #dx-col-5 {
            text-align: left !important;
        }

        .dx-datagrid .dx-datagrid-content .dx-datagrid-table .dx-row > td {
            text-align: left !important;
        }

        .custom-control-input:checked~.custom-control-label::before {
            color: #fff;
            border-color: #00857A;
            background-color: #00857A;
        }

        .custom-switch .custom-control-input:disabled:checked~.custom-control-label::before {
            background-color: #81B4AF;
        }

        .custom-control-input:disabled~.custom-control-label, .custom-control-input[disabled]~.custom-control-label {
            cursor: unset !important;
        }

        .custom-switch .custom-control-label::after {
            background-color: #00857A;
        }

    </style>

    <script src="./js/parametres.js"></script>