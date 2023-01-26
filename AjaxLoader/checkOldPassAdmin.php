<?php

include "../Autoload.php";

$oldPass = md5(md5($_POST['password']));

$data = DbAdministrateur::checkOldPass($oldPass);

echo $data;