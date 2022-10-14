<?php
include "../Autoload.php";

if ($_POST["Type"] == "admin") {
    $oldPass = DbAdministrateur::CheckPassActuel(SessionHelper::GetCurrentUserAdministrateur()->Id);
} else {
    $oldPass = DbUtilisateur::CheckPassActuel(SessionHelper::GetCurrentUser()->Id);
}

$data = (md5($_POST["Password"]) == $oldPass) ? 1 : -1 ;

echo $data;