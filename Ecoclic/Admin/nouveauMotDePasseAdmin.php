<?php
include "./head.php";
?>

<link rel="stylesheet" href="../css/numeriscore.css">
<link rel="stylesheet" href="../css/placeholderRGAA.css">

<body class="container-fluid ">
    <div class="row ">
        <div class="col-lg-5 col-xl-5"></div>
        <div id="userSpace" class="justify-content-between col-lg-7 col-xl-7 row center">
            <div class="col-12">
                <img src="../img/logo.png" alt="logo Luciole, design" class="top logo d-block mx-auto mt-2" style="width: 25%;">

                <form id="form404" action="../AjaxLoader/nouveauMDPAdmin.php" method="post" class="col-11 col-lg-7">
                    <p class="col text-center mt-4">Saisir votre nouveau mot de passe ci-dessous</p>
                    <p class="text-right col-12 mt-4 blueAdico"> <span class="text-danger">*</span> Champs obligatoires </p>
                    
                    <!-- Mail -->
                    <div id="nouveauMDP" class="formRow">
                        <fieldset class="formRow mb-2 mt-4">
                            <input type="text" hidden name="code">
                            <div class="formRow--item">
                                <p> Nouveau mot de passe <span class="text-danger">*</span> : </p>
                                <label for="password_input" class="formRow--input-wrapper js-inputWrapper">
                                    <input type="password" class="formRow--input js-input form-input" id="password_input" placeholder="Nouveau mot de passe" required name="password_input">
                                    <span class="iconIdentifiant" title=""><i class="fas fa-check"></i></span>
                                </label>
                            </div>
                            <div class="col-12 px-0">
                                <img id="iconAlert" style="width: 4%;" src="../img/icons/alert.svg" alt="alert">
                                <span>
                                    Votre mot de passe doit comporter au minimum 12 caractères dont : une minuscule, une majuscule, un chiffre et un caractère spécial
                                </span>
                            </div>

                            <div class="formRow--item mt-4">
                                <p> Confirmer le nouveau mot de passe <span class="text-danger">*</span> : </p>
                                <label for="nex_password_input" class="formRow--input-wrapper js-inputWrapper">
                                    <input type="password" class="formRow--input js-input form-input iconMDP" id="nex_password_input" name="nex_password_input" placeholder="Confirmer le nouveau mot de passe">
                                    <span class="iconPass" title="Afficher mot de passe"><img class="iconPassSize" src="../img/icons/Oeil.svg" alt=""></span>
                                </label>
                            </div>
                        </fieldset>

                        <div class="col-6">
                            <button type="submit" class="btn btn-vertNumeriscore rounded-pill text-white mt-10 col-12 fs"> Enregistrer </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script src="../js/placeholderRGAA.js"></script>
    <script src="../js/motdepasse_oublie.js"></script>
</body>