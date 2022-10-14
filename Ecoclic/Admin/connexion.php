<?php
//on charge les classes 

include "../Autoload.php";



//on recupere les parametres d'entrée
$password = md5($_POST['password_input_eyes']);
$logging = $_POST['username_input_login'];

$utilisateurId = DbAdministrateur::GetIdAdmin($logging, $password);

//var_dump($password, $utilisateurId);exit;
if ($utilisateurId == -1) {
    echo "Pseudo ou Email incorect!";
} else {
    Token::GeneratTokenAdmin($utilisateurId);
    SessionHelper::InitSessionAdmin($utilisateurId);
    if ($_SESSION['URL'] != '') {
        header('Location: ' . $_SESSION['URL']);
    } else {
        header('Location: ./themes.php');
    }

}
echo '<HTML>
    <HEAD>
        <TITLE>Recup info</TITLE>
        <meta http-equiv="Refresh" content="1;URL=./themes.php">
    </HEAD>
</HTML>';
