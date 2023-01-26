<?php 

include "../Autoload.php";

$display = $_GET['display'];

echo DbPreference::InsertPreference(SessionHelper::GetCurrentUser()->Id, "MENU_VISIBILITY", $display);