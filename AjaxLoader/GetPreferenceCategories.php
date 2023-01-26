<?php 

include "../Autoload.php";

$userId = SessionHelper::GetCurrentUser()->Id;

echo DbPreference::GetPreference($userId, "MENU_VISIBILITY");