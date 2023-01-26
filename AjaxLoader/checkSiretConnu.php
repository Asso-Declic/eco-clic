<?php 

include "../Autoload.php";

$siret = $_GET['siret'];

echo DbCollectivite::checkSiretConnu($siret);