<?php

    include "../Autoload.php";

    $IdSup = json_decode($_POST["IdSup"]);

    $result = -1;

    $result = DbCategorie::SupCateg($IdSup);

    echo $result;

?>