<?php

    include "../Autoload.php";

    $data = new stdClass;
    $data->UserId = json_decode($_POST["UserId"]);
    $data->QuestionId = json_decode($_POST["QuestionId"]);

    DbReponse::DeleteReponse($data);

?>