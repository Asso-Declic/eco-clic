<?php
include '../Autoload.php';

if (isset($_GET['i'])) {
    $i = $_GET['i'];
} else {
    $i=0;
}

if (isset($_GET['Id'])) {
    $idMdp = $_GET['Id'];
    $utilisateurId = DbAdministrateur::CheckIdMotDePasseOublie($idMdp);

    if ($utilisateurId == -1) {
        echo "
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css' integrity='sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk' crossorigin='anonymous'>
        <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
        <link href='http://www.jqueryscript.net/css/jquerysctipttop.css' rel='stylesheet' type='text/css'>
        <link href='http://www.jqueryscript.net/css/jquerysctipttop.css' rel='stylesheet' type='text/css'>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js' integrity='sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI' crossorigin='anonymous'></script>
        <link rel='icon' type='image/x-icon' href='../img/favicon.png'>

        <link rel='stylesheet' href='../css/index.css'>
        <link rel='stylesheet' href='../css/ecoclic.css'>
         <link rel='stylesheet' href='../css/placeholderRGAA.css'>
        
         <body class='container-fluid '>
             <div class='row '>
                 <div class='col-lg-5 col-xl-5'></div>
                 <div id='userSpace' class='justify-content-between row center'>
                     <div class='col-12'>
                         <img src='../img/logoEcoclic.png' alt='logo Ecoclic, design' class='top col-5 logo d-block mx-auto'>
                         <p class='col-6 text-center mt-5'> Erreur lien invalide ou expiré </p>
                     </div>
        
                 </div>
             </div>
             <script src='../js/placeholderRGAA.js'></script>
             <script src='../js/changementMdp.js'></script>
         </body>";
    } else {
        echo " 
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css' integrity='sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk' crossorigin='anonymous'>
        <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
        <link href='http://www.jqueryscript.net/css/jquerysctipttop.css' rel='stylesheet' type='text/css'>
        <link href='http://www.jqueryscript.net/css/jquerysctipttop.css' rel='stylesheet' type='text/css'>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js' integrity='sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI' crossorigin='anonymous'></script>
        <link rel='stylesheet' href='../css/index.css'>
        <link rel='stylesheet' href='../css/ecoclic.css'>
        <link rel='stylesheet' href='../css/placeholderRGAA.css'>
        <link rel='icon' type='image/x-icon' href='../img/favicon.png'>
        
        <body class='container-fluid '>
            <div class='row '>
                <div class='col-lg-5 col-xl-5'></div>
                <div id='userSpace' class='justify-content-between  row center'>
                    <div class='col-12'>
                        <img src='../img/logoEcoclic.png' alt='logo Ecoclic, design' class='top logo d-block mx-auto mt-5' style='width: 25%;'>
                        <form action=" . Config::read('domaine') . "Admin/ClearMotDePasseOublie.php?Id=$idMdp method='post' class='col-11 col-lg-7'>
                            <p class='col- text-center fs mt-4'>Saisir votre nouveau mot de passe ci-dessous</p>
                            <p class='text-right col-12 mt-4'> * Champs obligatoires </p>
        
                            <fieldset>
        
                               <!-- Règles mdp -->
                               <div class='col-12 d-flex'>
                                   <img src='../img/alert.svg' alt='Iconne alerte' class='iconAlert' style='height: 1.5em;'>
                                   <p class='passRules px-1'>
                                       Le mot de passe doit comporter 8 caractères dont une minuscule, une majuscule, un chiffre et un caractère spécial
                                   </p>
                               </div>
        
                               <!-- Nouveau mot de passe -->
                               <fieldset class='formRow mt-4 mb-3'>
                                   <div class='formRow--item'>
                                      <p> Nouveau mot de passe *: </p>
                                       <label for='new_pass' class='formRow--input-wrapper js-inputWrapper'>
                                           <input type='password' class='formRow--input js-input form-input' id='new_pass' placeholder='Nouveau mot de passe' 
                                           pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?#&])[A-Za-z\d@$!%*?#&]{8,}$' required name='new_pass'>
                                           <span class='iconPass' title='Afficher mot de passe'><img class='iconPassSize' src='../img/Oeil.svg' alt=''></span>
                                       </label>
                                   </div>
                               </fieldset>
        
                               <!-- Confirmation nouveau mot de passe -->
                               <fieldset class='formRow mb-3'>
                                   <div class='formRow--item'>
                                      <p> Confirmer le nouveau mot de passe *: </p>
                                       <label for='conf_new_pass' class='formRow--input-wrapper js-inputWrapper'>
                                           <input type='password' class='formRow--input js-input form-input' id='conf_new_pass' placeholder='Confirmer le nouveau mot de passe' 
                                           required name='conf_new_pass'>
                                       </label>
                                   </div>
                               </fieldset>
                               <span hidden id='pswConfirm' style='margin-bottom:10px !important;' class='text-danger alerts col-12 row mb-3'>Veuillez entrer les mêmes mot de passe</span>
        
                               <div class='col-6'>
                                   <button type='submit' class='btn btn-blueAdico col-12 d-block fs rounded-pill white'> Enregistrer </button>
                               </div>
                            </fieldset>
                        </form>
                    </div>
        
                </div>
            </div>
            <script src='../js/placeholderRGAA.js'></script>
            <script src='../js/changementMdp.js'></script>
            <script>
                if(".$i." == 1) {
                    document.getElementById('pswConfirm').removeAttribute('hidden')
                }
            </script>
        </body> <title>L'éco-clic Admin - Mot de passe oublié</title>";
    }
}
