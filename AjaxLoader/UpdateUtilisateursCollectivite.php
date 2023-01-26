<?php

include "../Autoload.php";

    $data = new stdClass;
    $data->Id = $_GET["Id"];
    $data->Nom = $_GET["Nom"];
    $data->Prenom = $_GET["Prenom"];
    $data->Identifiant = $_GET["Identifiant"];
    $data->Mail = $_GET["Mail"];
    // if (isset($_GET["Actif"])) {
    //     $data->Actif = 1;
    // }else {
    //     $data->Actif = 0;
    // }

    if (isset($_GET["Admin"])) {
        $data->Admin = 1;
    }else {
        $data->Admin = 0;
    }

DbUtilisateur::UpdateUtilisateur($data);
header("Location: ../parametres.php");
?>