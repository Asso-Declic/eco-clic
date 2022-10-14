<?php

    include "../Autoload.php";

    $data = new stdClass;
    $data->UserId = json_decode($_POST["UserId"]);
    $data->ReponseId = json_decode($_POST["ReponseId"]);
    $data->QuestionId = json_decode($_POST["QuestionId"]);
    $data->InputText = json_decode($_POST["InputText"]);

    $result = -1;

    $result = DbReponse::InsertReponse($data);

    echo $result;

?>