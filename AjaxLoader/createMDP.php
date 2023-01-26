<?php
include "../Autoload.php";


$password = md5(md5($_POST["password_input"]));
$code = $_POST["code"];

$retour = DbUtilisateur::newMdp($code, $password);

echo $retour;