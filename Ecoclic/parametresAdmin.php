<?php
include "./Autoload.php";
?>

<?php include "Common.php"?>

<?php
    if(SessionHelper::GetCurrentUser()->SuperAdmin == 0){
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

    <div class="col-12 fil-ariane py-2 px-4">
        <img src="./img/parametres.svg" alt=""> 
        <a class="fil-ariane" href="./parametresAdmin.php">Paramètres administrateur</a>
    </div>

    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
    

    <div class="pt-5 d-flex col-12 justify-content-between">
        <span class="sous-titre">Paramètres administrateur</span>
    </div>

    <div id="divBtnParam" class="d-flex col-12">

        <a href="./parametres.php" class="lien">
            <button class="bouton-ecoclic carre rounded text-white">
                <i class="fas fa-user pr-2"></i>
                </br>Gestion utilisateur
            </button>
        </a>

        <a href="./gestQuestionnaire.php">
            <button class="bouton-ecoclic carre rounded text-white">
                <i class="fa-solid fa-question pr-2"></i>
                </br>Gestion questionnaire
            </button>
        </a>
    </div>

    