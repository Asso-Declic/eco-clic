<?php 

include "../Autoload.php";

$Password = md5($_POST["Nouveau_mot_de_passe"]);
echo DbUtilisateur::UpdatePasswordUser(SessionHelper::GetCurrentUser()->Id, $Password);

if (isset($_SESSION['EXURL']) && $_SESSION['EXURL'] != "") {
    header("Location: ../".$_SESSION['EXURL']);
}else {
    header("Location: ../accueil.php");
}