<?php

    include "../Autoload.php";

    $userId = $_POST["userId"];

    $result = -1;

    $result = DbUtilisateur::deleteUser($userId);

    echo $result;

?>