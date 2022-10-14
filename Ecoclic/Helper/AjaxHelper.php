<?php

class AjaxHelper
{

    //permet de transformer un string ou un tableau au format uft8
    public static function ToUtf8($d)
    {
        if (is_array($d)) {
            foreach ($d as $k => $v) {
                $d[$k] = static::ToUtf8($v);
            }
        } else if (is_string($d)) {
            return utf8_encode($d);
        }
        return $d;
    }

    //retourne un tableau en Json au format etf8 pour les tableaux ajax
    public static function ToJson($array)
    {
        return json_encode(static::ToUtf8($array), JSON_UNESCAPED_UNICODE);
    }
}
