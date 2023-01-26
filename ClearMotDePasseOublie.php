<?php
include "./Autoload.php";

if ($_POST['new_pass'] == $_POST['conf_new_pass']) {
    DbUtilisateur::UpdateMDPOublie($_GET['Id'], md5(md5($_POST['new_pass'])));

    header('Location: ./index.php');
} else {
    header('Location: ./changementMdp.php?i=1&Id='.$_GET['Id']);
}
