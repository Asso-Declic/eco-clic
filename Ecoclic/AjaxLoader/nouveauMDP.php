<?php
include "../Autoload.php";


$password = md5($_POST["password_input"]);
$code = $_POST["code"];

$retour = DbUtilisateur::SetMdp($code, $password);

echo $retour;
