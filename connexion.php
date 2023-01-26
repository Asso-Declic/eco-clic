<?php
  //on charge les classes 

include "Autoload.php";

//on recupere les parametres d'entr�e
$password = md5(md5($_POST['password_input_eyes']));
$logging = $_POST['username_input_login'];

$utilisateurId = DbUtilisateur::GetId($logging, $password);

if ($utilisateurId == -1)
{
    echo "Email ou mot de passe incorect!";
}
else
{
    Token::GeneratToken($utilisateurId);
    SessionHelper::InitSession($utilisateurId);

    if($_SESSION['URLCB'] != '')
    {
        header('Location: '.$_SESSION['URLCB'] );
    }
    else
    {
        header('Location: ./accueil.php');
    }
}

?>

<HTML>
    <HEAD>
        <TITLE>Recup info</TITLE>
        <meta http-equiv="Refresh" content="1;URL=./accueil.php">
        <link rel='icon' type='image/x-icon' href='img/favicon.png'>
    </HEAD>
</HTML>