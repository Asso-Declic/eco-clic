<?php
include "../Autoload.php";

$data = DbAdministrateur::GetUtilisateur(SessionHelper::GetCurrentUser()->Id);

echo AjaxHelper::ToJson($data);