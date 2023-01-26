<?php

    include "../Autoload.php";

    $data = new stdClass;
    $data->theme = json_decode($_POST["theme"]);
    $data->categId = json_decode($_POST["categId"]);

    $result = -1;

    $result = DbTheme::InsertTheme($data);

    echo $result;

?>