<?php
include "../Autoload.php";
$AdministrateurId = SessionHelper::GetCurrentUserAdministrateur()->Id;
DbAdministrateur::SetToken($AdministrateurId, null);
setcookie("baseadico",1, time()+1, "/");
setcookie("TokenAdmin",1, time()+1, "/");
if(session_status() == PHP_SESSION_ACTIVE) 
{
    session_destroy();
}




?>

<HTML>
    <HEAD>
        <TITLE>Recup info</TITLE>
        <meta http-equiv="Refresh" content="1;URL=./index.php">
    </HEAD>
</HTML>
<script>

localStorage.clear();

</script>