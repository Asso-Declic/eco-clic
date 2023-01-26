<?php
include "../Autoload.php";


$pasword = md5(md5($_POST["password_input"]));
$code = $_GET["Id"];

    $retour = DbAdministrateur::SetMdp($code, $pasword);
    header("Location: ../Admin/index.php");


    echo $retour;
