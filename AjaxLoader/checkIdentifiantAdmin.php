<?php

include "../Autoload.php";
    $results = 1;
    $Identifiant = $_GET['Identifiant'];
    $IdentifiantBDD = DbAdministrateur::GetIdDisponibility($Identifiant);
    
    if ($IdentifiantBDD != "") {
        echo -1;
    } else {
        echo "";
    }
    
?>