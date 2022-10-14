<?php 

include "../Autoload.php";

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

echo AjaxHelper::ToJson($_GET);

$Utilisateur = New Utilisateur;
$Utilisateur->Prenom = $_GET["Prenom"];  
$Utilisateur->Nom = $_GET["Nom"];  
$Utilisateur->Mail = $_GET["Mail"];
$Utilisateur->Identifiant = $_GET["Identifiant"];
$Utilisateur->CGU = 0;
$Utilisateur->CollectiviteId = SessionHelper::GetCurrentUser()->CollectiviteId;
if (isset($_GET["Actif"])) {
    $Utilisateur->Actif = 1;
}else {
    $Utilisateur->Actif = 0;
}

if (isset($_GET["Administrateur"])) {
    $Utilisateur->Admin = 1;
}else {
    $Utilisateur->Admin = 0;
}

$Utilisateur->Password = "";

$results = DbUtilisateur::InsertUtilisateur($Utilisateur);

header('Location: ../parametres.php');