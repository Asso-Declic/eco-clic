<?php

include "../Autoload.php";

$oldPass = md5(md5($_POST['password']));

$data = DbUtilisateur::checkOldPass($oldPass);

echo $data;