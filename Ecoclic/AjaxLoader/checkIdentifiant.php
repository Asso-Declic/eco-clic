<?php

include "../Autoload.php";

    $results = DbUtilisateur::GetIdDisponibility($_GET['Identifiant']);

echo $results;
?>