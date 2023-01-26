<?php

include "../Autoload.php";

    $administrateur = New Utilisateur;
    $administrateur->Prenom = $_GET["Prenom"];  
    $administrateur->Nom = $_GET["Nom"];  
    $administrateur->Mail = $_GET["Mail"];
    $administrateur->Identifiant = $_GET["Identifiant"];
    if (isset($_GET["Actif"])) {
        $administrateur->Actif = 1;
    }else {
        $administrateur->Actif = 0;
    }
    $administrateur->SuperAdmin = 0;
    $administrateur->OPSNId = SessionHelper::GetCurrentUserAdministrateur()->OPSNId;
    $administrateur->Password = "";

    $results = DbAdministrateur::InsertUtilisateur($administrateur);

    header('Location: ../Admin/utilisateursOPSN.php');

?>