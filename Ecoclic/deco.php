<?php
include "./Autoload.php";
session_start ();
$utilisateurId = SessionHelper::GetCurrentUser()->Id;
DbUtilisateur::SetToken($utilisateurId, null);
setcookie("TokenCB",1, time()+1, "/");
if(session_status() == PHP_SESSION_ACTIVE) 
{
    session_destroy();
}




?>

<HTML>
    <HEAD>
        <TITLE>Recup info</TITLE>
        <meta http-equiv="Refresh" content="1;URL=./index.php">
        <link rel="icon" type="image/png" href="img/Favicon_Chatbot_72ppp.png" />
    </HEAD>
</HTML>