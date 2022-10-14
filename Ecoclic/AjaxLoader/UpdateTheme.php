<?php

    include "../Autoload.php";

    $data = new stdClass;
    $data->themeId = json_decode($_POST["themeId"]);
    $data->theme = json_decode($_POST["theme"]);
    $data->categId = json_decode($_POST["categId"]);

    $result = -1;

    $result = DbTheme::UpdateTheme($data);

    echo $result;

?>