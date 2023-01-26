<?php 

include "../Autoload.php";

$Password = md5(md5($_POST["Nouveau_mot_de_passe"]));
echo DbAdministrateur::UpdatePasswordAdmin(SessionHelper::GetCurrentUser()->Id, $Password);

if (isset($_SESSION['EXURL']) && $_SESSION['EXURL'] != "") {
    header("Location: ../Admin/".$_SESSION['EXURL']);
}else {
    header("Location: ../Admin/collectivite.php");
}