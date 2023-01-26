<?php

    include "../Autoload.php";

    $data = new stdClass;
    $data->categId = json_decode($_POST["categId"]);
    $data->descCateg = json_decode($_POST["descCateg"]);
    $data->titreCateg = json_decode($_POST["titreCateg"]);
    $data->imgCateg = json_decode($_POST["imgCateg"]);

    $result = -1;

    $result = DbCategorie::InsertCateg($data);

    echo $result;

?>