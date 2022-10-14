<?php
include "./Autoload.php";
?>

<?php include "Common.php"?>


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
        <a class="fil-ariane" href="./profil.php">Profil</a>            
    </div>

<div class="pt-5 d-flex col-12 justify-content-between">
    <span class="sous-titre">Modifer mon profil</span>
</div>

<div class="mt-5 px-3">
    <form action="./AjaxLoader/UpdateUtilisateurProfil.php" id="formulaire">
        <div id="form_profil"></div>
    </form>
</div>

<script src="./js/profil.js"></script>