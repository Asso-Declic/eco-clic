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
Config::write('db.host', '');
Config::write('db.port', '');
Config::write('db.basename', '');

Config::write('db.user', '');
Config::write('db.password', '');
//token
Config::write('token.key', 'code_ultra_secret_a_changer');
Config::write('token.validite', '14400');

//configuration des mails
Config::write('mail.enabled', true);
Config::write('mail.senderName', 'Ecoclic');
Config::write('mail.senderMail', '');
Config::write('mail.SMTPHost', '');
Config::write('mail.SMTPPassword', '');

Config::write('domaine', 'https://ecoclic.fr/');
