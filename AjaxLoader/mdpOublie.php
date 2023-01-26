<?php

include "../Autoload.php";

$mail = $_POST["email_input"];
$IdMDPOublie = Guid::NewGuid();

echo DbUtilisateur::InsertMDPOublie($mail, $IdMDPOublie);

#partie a changer par l'envoi de mail
header("Location: ../nouveauMotDePasse.php?m=" . $IdMDPOublie . "&type=r");
