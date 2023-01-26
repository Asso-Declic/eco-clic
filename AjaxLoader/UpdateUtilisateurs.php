<?php

include "../Autoload.php";

    $data = new stdClass;
    $data->Id = $_GET["Id"];
    $data->Nom = $_GET["Nom"];
    $data->Prenom = $_GET["Prenom"];
    $data->Identifiant = $_GET["Identifiant"];
    $data->Mail = $_GET["Mail"];
    $data->Actif = $_GET["Actif"];
    if (isset($_GET["Actif"])) {
        $data->Actif = 1;
    }else {
        $data->Actif = 0;
    }

DbAdministrateur::UpdateUtilisateur($data);
header("Location: ../Admin/utilisateurs.php");
?>