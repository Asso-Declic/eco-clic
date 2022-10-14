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
        <i class="fas fa-chevron-right" style="color:#08433D"></i>
        <img src="./img/recommandations.svg" alt="">
        <a class="fil-ariane" href="./gestQuestionnaire.php">Gestion questionnaire</a>
    </div>

    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />

    <div class="pt-5 d-flex col-12 justify-content-between">
        <span class="sous-titre">Gestion des questionnaires</span>
    </div>

    <div id="divBtnParam" class="d-flex col-12">
        
        <a href="./gestCateg.php" class="lien">
            <button class="bouton-ecoclic carre rounded text-white">
                <img class="iconMenu" src="img/bubbleWhite.svg">
                </br>Catégories
            </button>
        </a>

        <a href="./gestTheme.php" class="lien">
            <button class="bouton-ecoclic carre rounded text-white">
                <i class="fa-solid fa-vr-cardboard pr-2"></i>
                </br>Thèmes
            </button>
        </a>

        <a href="./gestQuestion.php" class="lien">
            <button class="bouton-ecoclic carre rounded text-white">
                <i class="fa-solid fa-clipboard-question pr-2"></i>
                </br>Questions
            </button>
        </a>

        <a href="./gestReco.php" class="lien">
            <button class="bouton-ecoclic carre rounded text-white">
                <i class="fa-solid fa-question pr-2"></i>
                </br>Recommandations
            </button>
        </a>
    
    </div>

</div>