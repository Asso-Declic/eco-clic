<?php

class FilterHelper
{

    //permet de transformer un string ou un tableau au format uft8
    public static function Decompose($d)
    {
        $MysqlFilter = "";
        if (is_array($d)) {
            $MysqlFilter = $MysqlFilter . "( ";

            if (sizeof($d) == 3 && is_string($d[0])) {
                switch ($d[1]) {
                    case 'startswith':
                        $MysqlFilter = $MysqlFilter . $d[0] . " like '" . $d[2] . "%' ";
                        break;
                    case 'endswith':
                        $MysqlFilter = $MysqlFilter . $d[0] . " like '%" . $d[2] . "' ";
                        break;
                    case 'contains':
                        $MysqlFilter = $MysqlFilter . $d[0] . " like '%" . $d[2] . "%' ";
                    break;
                    default:
                        $MysqlFilter = $MysqlFilter . $d[0] . " " . $d[1] . " '" . $d[2] . "'";
                }

            } else {
                foreach ($d as $k => $v) {
                    $MysqlFilter = $MysqlFilter . " " . static::Decompose($v) . " ";
                }
            }
            $MysqlFilter = $MysqlFilter . " )";
        } else if (is_string($d)) {

            $MysqlFilter = $MysqlFilter . $d;
        }
        return $MysqlFilter;
    }

    //retourne un tableau en Json au format etf8 pour les tableaux ajax
    public static function ToMysql($array)
    {
        return " WHERE 1=1 and " . static::Decompose($array);
    }
}
