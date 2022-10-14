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
                
                <form action="../AjaxLoader/mdpOublieAdmin.php" method="post" class="col-11 col-lg-7">
                    <p class="col- text-center fs mt-4">Modifier votre mot de passe</p>
                    <p class="col-12 mt-5"> Veuillez renseigner votre adresse Email ci-dessous </p>
                    <p class="text-right col-12 mt-4 blueAdico"> * Champs obligatoires </p>

                    <!-- Mail -->
                    <fieldset class="formRow mb-5 mt-4">
                        <div class="formRow--item">
                           <p> Adresse Mail* : </p>
                            <label for="email_input" class="formRow--input-wrapper js-inputWrapper">
                                <input type="email" class="formRow--input js-input form-input" id="email_input" placeholder="Mail*" 
                                required name="email_input">
                            </label>
                        </div>
                    </fieldset>

                    <div class="col-6">
                        <button type="submit" class="btn btn-vertNumeriscore rounded-pill text-white mt-10 col-12 fs"> Valider </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script src="../js/placeholderRGAA.js"></script>
    <script src="../js/motdepasse_oublie.js"></script>
</body>