<?php

//on charge l'autoload des classes
include "Autoload.php";

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION['URLCB'])) {
    if ($_SESSION['URLCB'] != basename($_SERVER['REQUEST_URI'])) {
        $_SESSION['EXURL'] = $_SESSION['URLCB'];
        $_SESSION['URLCB'] = basename($_SERVER['REQUEST_URI']);
    }
} else {
    $_SESSION['EXURL'] = '';
    $_SESSION['URLCB'] = basename($_SERVER['REQUEST_URI']);
}

//si les cookies ne sont pas renseignés
if (!isset($_COOKIE['TokenCB'])) {
    //on retourne a la page de log
    header('Location: ./index.php');
    $_SESSION['EXURL'] = $_SESSION['URLCB'];
    $_SESSION['URLCB'] = basename($_SERVER['REQUEST_URI']);
    exit();
} else {
    //si le ticket n'est plus valide
    $utilisateurId = Token::CheckToken();
    if ($utilisateurId == -1) {
        //on retourne a la page de log
        header('Location: ./index.php');
        $_SESSION['EXURL'] = $_SESSION['URLCB'];
        $_SESSION['URLCB'] = basename($_SERVER['REQUEST_URI']);
        
        exit();
    } else {
        
        //sinon on genere le nouveau ticket
        Token::GeneratToken($utilisateurId);
        SessionHelper::InitSession($utilisateurId);
    }
}

