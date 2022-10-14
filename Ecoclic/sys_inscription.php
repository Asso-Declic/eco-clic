<?php
//on charge les classes 

include "./Autoload.php";

if($_POST['Type_de_collectivité'] == 'MAIRIE')                     { $typeCol =  "57482110-fe97-11eb-acf0-0cc47a0ad120";}
if($_POST['Type_de_collectivité'] == 'COMMUNAUTE DE COMMUNES')     { $typeCol =  "5748268d-fe97-11eb-acf0-0cc47a0ad120";}
if($_POST['Type_de_collectivité'] == 'AUTRE')                      { $typeCol =  "8f9d4a91-fff3-11eb-acf0-0cc47a0ad120";}
if($_POST['Type_de_collectivité'] == 'COMMUNAUTE D\'AGLOMERATION') { $typeCol =  "3e85465a-ffff-11eb-acf0-0cc47a0ad120";}

$collectivite = new Collectivite;
$collectivite->Id = Guid::NewGuid();
$collectivite->Siret = $_POST["Siret"];
$collectivite->Population = $_POST["Population"];
$collectivite->Nom = $_POST["Denomination"];
$collectivite->Type = $typeCol;
$collectivite->CodePostal = $_POST["Code_postal"];
$collectivite->Latitude = $_POST["Latitude"];
$collectivite->Longitude = $_POST["Longitude"];

$user = new Utilisateur;
$user->Nom = $_POST["Nom"];
$user->Prenom = $_POST["Prénom"];
$user->Identifiant = $_POST["Identifiant"];
$user->Mail = $_POST["E-mail"];
$user->CollectiviteId = $collectivite->Id;
$user->Password = md5($_POST["Mot_de_passe"]);
$user->Actif = 1;
$user->Admin = 1;
$user->CGU = 1;

$success1 = DbUtilisateur::InsertUtilisateur($user);
$success2 = DbCollectivite::InsertCollectivite($collectivite);

if ($success1 == 1 && $success2 == 1) {
    header('Location: ./index.php');
} else {
    echo "erreur";
}
