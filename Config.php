<?php
class Config
{
    static $confArray;

    public static function read($name)
    {
        return self::$confArray[$name];
    }

    public static function write($name, $value)
    {
        self::$confArray[$name] = $value;
    }

}

// db
Config::write('db.host', 'ecoclimprod.mysql.db');
Config::write('db.port', '3306');
Config::write('db.basename', 'ecoclimprod');

Config::write('db.user', 'ecoclimprod');
Config::write('db.password', '8VQkcmiWPmemcs7idnnrrnHblX9teL');
//token
Config::write('token.key', 'code_ultra_secret_a_changer');
Config::write('token.validite', '14400');

//configuration des mails
Config::write('mail.enabled', true);
Config::write('mail.senderName', 'Ecoclic');
Config::write('mail.senderMail', 'nepasrepondre@ecoclic.fr');
Config::write('mail.SMTPHost', 'envoisite@adico.fr');
Config::write('mail.SMTPPassword', '3%Hb5i)S4mL}');

Config::write('domaine', 'https://ecoclic.fr/');

?>