<?php 
include "../Autoload.php";

    $data = MailHelper::SendMailInscriptionUtilisateur($_POST["Mail"], $_POST["Id"]);

    echo 1;
?>