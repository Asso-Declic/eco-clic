<?php
  //on charge les classes 

include "./Autoload.php";

if(session_status() != PHP_SESSION_ACTIVE) 
{
    session_start();
}  

//on recupere les parametres d'entrée
$mail = $_POST['email_input'];

$utilisateur = DbUtilisateur::GetUtilisateurByMail($mail);
//$user = SessionHelper::GetCurrentUserCollectivite();

if ($utilisateur->Id == '')
{
    echo "Email incorect!";
}
else
{
    $id = Guid::NewGuid();


    DbUtilisateur::UpdateMotDePasseOublie($id, $utilisateur->Id);

    $recuperation = $id;

    echo "<link rel='stylesheet' href='./css/index.css'>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css' integrity='sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk' crossorigin='anonymous'>
    <link rel='icon' type='image/x-icon' href='img/favicon.png'>
    <link rel='stylesheet' href='./css/ecoclic.css'>
    <link rel='stylesheet' href='./css/placeholderRGAA.css'>
    
    <body class='container-fluid d-flex'>
        <div class='align-content-around flex-fill row '>
            <div class='col-lg-5 col-xl-5'></div>
                <div id='userSpace' class='center'>
                    <div class='col-12'>
                        <img src='./img/logoEcoclic.png' alt='logo Ecoclic, design' class='top col-5 logo d-block mx-auto'>
                        <p class='col-6 text-center fs mt-5'> Modifier votre mot de passe </p>
                    </div>
                    <div class='col-12'>
                        <p class='col-6 text-center fs mt-5'> Vous allez recevoir un mail sur l'adresse $mail, pensez à vérifier vos spams</p>
                    </div>
                </div>
            </div>
        </div>
        <script src='./js/placeholderRGAA.js'></script>
        <script src='./js/changementMdp.js'></script>
    </body><title>L'éco-clic - Mot de passe oublié</title>";

    MailHelper::SendMailMotDePasseOublie($mail, $utilisateur->Nom, $utilisateur->Prenom, $recuperation);

}