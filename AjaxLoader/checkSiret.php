<?php

include "../Autoload.php";

    $results = DbCollectivite::GetSiretDisponibility($_GET['Siret']);

echo $results;
?>