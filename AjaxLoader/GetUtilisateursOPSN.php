<?php 
include "../Autoload.php";
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
    $data = DbAdministrateur::GetUtilisateursOPSN(SessionHelper::GetCurrentUserAdministrateur()->OPSNId);

echo AjaxHelper::ToJson($data) 
?>