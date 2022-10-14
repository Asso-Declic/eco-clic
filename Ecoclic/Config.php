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
Config::write('db.host', '109.234.164.31');
Config::write('db.port', '3306');
Config::write('db.basename', 'sc1viem4645_ecoclic2');

Config::write('db.user', 'sc1viem4645');
Config::write('db.password', '7:N1pWwx:H}4+Zv,');
//token
Config::write('token.key', 'code_ultra_secret_a_changer');
Config::write('token.validite', '14400');

//configuration des mails
Config::write('mail.enabled', true);
Config::write('mail.senderName', 'Ecoclic');
Config::write('mail.senderMail', 'nepasrepondre@ecoclic.fr');
Config::write('mail.SMTPHost', 'envoisite@adico.fr');
Config::write('mail.SMTPPassword', '3%Hb5i)S4mL}');

Config::write('domaine', 'http://192.168.1.13/Ecoclic/');