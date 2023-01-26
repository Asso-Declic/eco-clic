<?php

include "../Autoload.php";

    $data = new stdClass;
    $data->Id = SessionHelper::GetCurrentUser()->Id;
    $data->Nom = $_GET["Nom"];
    $data->Prenom = $_GET["Prenom"];
    $data->Identifiant = $_GET["Identifiant"];
    $data->Mail = $_GET["Mail"];

DbAdministrateur::UpdateAdminProfil($data);
header("Location: ../Admin/profil.php");
?>