<?php
include "../Autoload.php";

$data = DbUtilisateur::GetUtilisateur(SessionHelper::GetCurrentUser()->Id);

echo AjaxHelper::ToJson($data);