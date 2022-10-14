<?php 
include "../Autoload.php";

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

    $data = DbUtilisateur::GetUtilisateursByCollectivite(SessionHelper::GetCurrentUser()->CollectiviteId);

echo AjaxHelper::ToJson($data) 
?>