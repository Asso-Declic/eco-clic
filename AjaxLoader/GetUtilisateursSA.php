<?php 
include "../Autoload.php";
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
    $data = DbAdministrateur::GetUtilisateursSA();

echo AjaxHelper::ToJson($data)
?>