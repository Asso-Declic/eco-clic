<?php

    include "../Autoload.php";

    $IdSup = json_decode($_POST["IdSup"]);

    $result = -1;

    $result = DbTheme::SupTheme($IdSup);

    echo $result;

?>