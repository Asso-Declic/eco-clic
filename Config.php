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
Config::write('db.host', 'bdd');
Config::write('db.port', '3306');
Config::write('db.basename', 'ecoclimprod');

Config::write('db.user', 'user');
Config::write('db.password', 'password');
//token
Config::write('token.key', 'code_ultra_secret_a_changer');
Config::write('token.validite', '14400');

//configuration des mails
Config::write('mail.enabled', true);
Config::write('mail.senderName', 'Ecoclic');
Config::write('mail.senderMail', 'nepasrepondre@ecoclic.fr');
Config::write('mail.SMTPHost', 'mail');
Config::write('mail.SMTPPassword', 'password');

Config::write('domaine', 'https://ecoclic.fr/');

?>
