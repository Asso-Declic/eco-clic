<?php
    // include "./head.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>L'éco-clic Admin - Nouveau mot de passe</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
    <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/21.1.5/css/dx.light.css">
    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../devExtreme/js/dx-quill.min.js"></script>
    <script src="../devExtreme/js/dx.all.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="../js/jquery.mask.min.js"></script>
    <script src="../js/common.js"></script>
    <script src="./js/header.js"></script>
    <link rel="stylesheet" href="../devExtreme/css/dx.common.css" />
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrapAdmin.css">
    <link rel="stylesheet" href="../css/dx-ecoclicAdmin.css">
    <link rel="stylesheet" href="../css/common-ecoclicAdmin.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/placeholderRGAA.css">
    <link rel='icon' type='image/x-icon' href='../img/favicon.png'>
</head>



<body class="container-fluid ">
    <div class="row ">
        <div class="col-lg-5 col-xl-5"></div>
        <div id="userSpace" class="justify-content-between col-lg-7 col-xl-7 row center">
            <div class="col-12">
                <img src="../img/logoEcoclic.png" alt="logo Ecoclic, design" class="top logo d-block mx-auto mt-2" style="width: 25%;">

                <form id="form404" action="../AjaxLoader/nouveauMDPAdmin.php?Id=<?php echo $_GET['Id']; ?>" method="post" class="col-11 col-lg-7">
                    <p class="col text-center mt-4">Saisir votre nouveau mot de passe ci-dessous</p>
                    <p class="text-right col-12 mt-4 blueAdico"> <span class="text-danger">*</span> Champs obligatoires </p>
                    
                    <!-- Mail -->
                    <div id="nouveauMDP" class="formRow">
                        <fieldset class="formRow mb-2 mt-4">
                            <div class="formRow--item">
                                <p> Nouveau mot de passe <span class="text-danger">*</span> : </p>
                                <label for="password_input" class="formRow--input-wrapper js-inputWrapper">
                                    <input type="password" class="formRow--input js-input form-input" id="password_input" placeholder="Nouveau mot de passe" pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?#&])[A-Za-z\d@$!%*?#&]{8,}$' required name="password_input">
                                    <span class="iconIdentifiant" title=""><i class="fas fa-check"></i></span>
                                </label>
                            </div>
                            <div class="col-12 px-0">
                                <img id="iconAlert" style="width: 4%;" src="../img/alert.svg" alt="alert">
                                <span>
                                    Votre mot de passe doit comporter au minimum 8 caractères dont : une minuscule, une majuscule, un chiffre et un caractère spécial
                                </span>
                            </div>

                            <div class="formRow--item mt-4">
                                <p> Confirmer le nouveau mot de passe <span class="text-danger">*</span> : </p>
                                <label for="nex_password_input" class="formRow--input-wrapper js-inputWrapper">
                                    <input type="password" class="formRow--input js-input form-input iconMDP" id="nex_password_input" name="nex_password_input" placeholder="Confirmer le nouveau mot de passe">
                                    <span class="iconPass" title="Afficher mot de passe"><img class="iconPassSize" src="../img/Oeil.svg" alt=""></span>
                                </label>
                            </div>
                        </fieldset>

                        <div class="col-6">
                            <button type="submit" class="d-block btn btn-blueAdico rounded-pill white col-12 col-lg-12 fs"> Enregistrer </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script src="../js/placeholderRGAA.js"></script>
    <script src="../js/motdepasse_oublie.js"></script>
</body>