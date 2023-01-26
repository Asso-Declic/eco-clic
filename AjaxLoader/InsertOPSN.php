<?php
include "../Autoload.php";
$OPSN = new stdClass;

(!isset($_GET["Id"])) ? $OPSN->Id = Guid::NewGuid() : $OPSN->Id = $_GET["Id"];
$OPSN->Nom = $_GET["Nom"];
$OPSN->Departement = $_GET["Departement"];

if (isset($_GET["Departement_de_travail"]) && $_GET["Departement_de_travail"] != "") {
    $Departement_de_travail = explode(",", $_GET["Departement_de_travail"]);
}
//echo AjaxHelper::ToJson($OPSN);

if (!isset($_GET["Id"])) { #Insert OPSN
    $OPSN->Id = Guid::NewGuid();
    $OPSN->Nom = $_GET["Nom"];
    $OPSN->Departement = $_GET["Departement"];
    $OPSN->Mail = $_GET["Mail"];
    $data = DbOPSN::InsertOPSN($OPSN);
    if (isset($_GET["Departement_de_travail"]) && $_GET["Departement_de_travail"] != "" && $data == 1) {
        $Departement_de_travail = explode(",", $_GET["Departement_de_travail"]);
        DbOPSN::SetDptTravail($OPSN->Id, $Departement_de_travail);
    }
    header('Location: ../Admin/modifOPSN.php?Id=' . $OPSN->Id);
} else { #Update OPSN
    $OPSN->Id = $_GET["Id"];
    $OPSN->Nom = $_GET["Nom"];
    $OPSN->Departement = $_GET["Departement"];
    $OPSN->Telephone = ($_GET["Telephone"] != "") ? $_GET["Telephone"] : null;
    $OPSN->Mail = ($_GET["Mail"] != "") ? $_GET["Mail"] : null;
    $OPSN->Adresse = ($_GET["Adresse"] != "") ? $_GET["Adresse"] : null;
    $OPSN->Site_internet = ($_GET["Site_internet"] != "") ? $_GET["Site_internet"] : null;
    $OPSN->Siret = ($_GET["Siret"] != "") ? $_GET["Siret"] : null;
    $OPSN->Latitude = ($_GET["Latitude"] != "") ? $_GET["Latitude"] : null;
    $OPSN->Longitude = ($_GET["Longitude"] != "") ? $_GET["Longitude"] : null;
    if (file_exists("../temp/output.png")) {
        rename("../temp/output.png", "../img/logos/logo" . $_GET["Id"] . ".png");
        $OPSN->Logo = "logo" . $_GET["Id"] . ".png";
    }
    if (!isset($OPSN->Logo)) {
        $OPSN->Logo = DbOPSN::GetOPSN($_GET["Id"])->Logo;
    }
    (isset($_GET["Actif"])) ? $OPSN->Actif = 1 : $OPSN->Actif = 0;
    $data = DbOPSN::UpdateOPSN($OPSN);
    if ($data == 1) {
        $Departement_de_travail = explode(",", $_GET["Departement_de_travail"]);
        DbOPSN::SetDptTravail($OPSN->Id, $Departement_de_travail);
    }
    header('Location: ../Admin/AdminOPSN.php');
    
}
