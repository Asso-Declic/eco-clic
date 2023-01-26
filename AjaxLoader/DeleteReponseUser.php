<?php

    include "../Autoload.php";

    $data = new stdClass;
    $data->CollectiviteId = json_decode($_POST["CollectiviteId"]);
    $data->QuestionId = json_decode($_POST["QuestionId"]);

    DbReponse::DeleteReponse($data);

?>