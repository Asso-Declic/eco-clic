<?php
include "head.php";
?>
<title>Numériscore</title>
<link rel="stylesheet" href="../css/numeriscore.css">
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../css/placeholderRGAA.css">

<body class="container-fluid ">
    <div id="contenu" class="row">

        <div id="espace" class="col-lg-5 col-xl-5">
        </div>

        <div id="userSpace" class="justify-content-between col-lg-7 col-xl-7 row center">
            <div class="col-12 mx-auto">
                <div class="my-auto">
                    <img src="../img/logo.png" alt="logo Numériscore, design" class="top logo mt-5 d-block mx-auto">

                    <form action="./connexion.php" method="post" class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
                        <?php
                        include "../Autoload.php";
                        if (isset($_COOKIE['TokenAdmin'])) {

                            $utilisateurId = Token::CheckTokenAdmin($_COOKIE['TokenAdmin']);
                            if ($utilisateurId != -1) {
                                SessionHelper::InitSessionAdmin($utilisateurId);
                                header('Location: ./themes.php');
                                exit();
                            }
                        }

                        ?>
                        <p class="text-center fs mt-4">Saisir vos informations ci-dessous</p>

                        <fieldset>
                            <!-- Identifiant -->
                            <fieldset class="formRow mb-3">
                                <div class="formRow--item col-12">
                                    <label for="username_input_login" class="formRow--input-wrapper js-inputWrapper">
                                        <input type="text" class="formRow--input js-input form-input" id="username_input_login" name="username_input_login" placeholder="Identifiant">
                                        <span class="iconIdentifiant" title=""><i class="fas fa-check"></i></span>
                                    </label>
                                </div>
                            </fieldset>

                            <!-- Mot de passe -->
                            <fieldset class="formRow mb-3">
                                <div class="formRow--item col-12">
                                    <label for="password_input_eyes" class="formRow--input-wrapper js-inputWrapper">
                                        <input type="password" class="formRow--input js-input form-input iconMDP" id="password_input_eyes" name="password_input_eyes" placeholder="Mot de passe">
                                        <span class="iconPass" title="Afficher mot de passe"><img class="iconPassSize" src="../img/icons/Oeil.svg" alt=""></span>
                                    </label>
                                </div>
                            </fieldset>

                            <a href="./motdepasse_oublie.php" class="text-right d-block col-12 vertNumeriscore sousligne">
                                <span id="forgotPass" class="opa80 fs">
                                    Mot de passe oublié ?
                                </span>
                            </a>
                            <button type="submit" class="d-block btn btn-vertNumeriscore rounded-pill text-white mt-5 col-6 fs"> Se connecter </button>

                        </fieldset>
                    </form>

                    <!-- <p class="opa80 text-center mt-5 fs">
                        Vous n'êtes pas encore inscrit ?
                        <a href="./inscription.php" class="vertNumeriscore sousligne">
                            Créer un compte
                        </a>
                    </p> -->
                </div>
            </div>
        </div>
    </div>
    <script src="http://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
    <script src="../js/placeholderRGAA.js"></script>
    <script src="../js/index.js"></script>
</body>