<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
spl_autoload_register ( function ($class) {

$sources = array("Helper/$class.php", "$class.php", "DataProvider/$class.php", "Filtre/$class.php", "AjaxLoader/$class.php", "Modele/$class.php", "PHPMailer/src/$class.php");

    foreach ($sources as $source) {
        if (file_exists($source)) {
            require_once $source;
        } 
        else
        {
            if (file_exists("../".$source))
            {
                require_once $source;
            }
        }
    } 
});

?>