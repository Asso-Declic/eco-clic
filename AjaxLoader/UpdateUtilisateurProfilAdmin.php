<?php

include "../Autoload.php";

    $data = new stdClass;
    $data->Id = SessionHelper::GetCurrentUser()->Id;
    $data->Nom = $_GET["Nom"];
    $data->Prenom = $_GET["Prenom"];
    $data->Identifiant = $_GET["Identifiant"];
    $data->Mail = $_GET["Mail"];
    if ($_GET["MotDePasse"] == -1) {
        $data->MotDePasse = $_GET["MotDePasse"];
    } else {
        $data->MotDePasse = md5(md5($_GET["MotDePasse"]));
    }

    DbAdministrateur::UpdateUtilisateurProfil($data);
// header("Location: ../profil.php");
?>