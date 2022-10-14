<?php

//on charge l'autoload des classes
include "../Autoload.php";

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION['URL'])) {
    if ($_SESSION['URL'] != basename($_SERVER['REQUEST_URI'])) {
        $_SESSION['EXURL'] = $_SESSION['URL'];
        $_SESSION['URL'] = basename($_SERVER['REQUEST_URI']);
    }
} else {
    $_SESSION['EXURL'] = '';
    $_SESSION['URL'] = basename($_SERVER['REQUEST_URI']);
}

//si les cookies ne sont pas renseignés
if (!isset($_COOKIE['TokenAdmin'])) {
    //on retourne a la page de log
    header('Location: ./index.php');
    $_SESSION['EXURL'] = $_SESSION['URL'];
    $_SESSION['URL'] = basename($_SERVER['REQUEST_URI']);
    exit();
} else {
    //si le ticket n'est plus valide
    $utilisateurId = Token::CheckTokenAdmin();
    if ($utilisateurId == -1) {

        //on retourne a la page de log
        header('Location: ./index.php');
        $_SESSION['EXURL'] = $_SESSION['URL'];
        $_SESSION['URL'] = basename($_SERVER['REQUEST_URI']);
        exit();
    } else {
        //on verifie maintenant si le ticket a atteint la moitié de sa vie
        if(Token::CheckTokenAdminValidity()==-1)
            {
                //si oui on genere le nouveau ticket
                Token::GeneratTokenAdmin($utilisateurId);
            }
        SessionHelper::InitSessionAdmin($utilisateurId);
    }
}