<?php

class HoraireHelper
{

    public static function ToString($horaire, $day, $halfday) {

        if($halfday==0)
        {
            if(isset($horaire[$day]->HoraireMatin) && $horaire[$day]->HoraireMatin != '')
            {
                $int =  $horaire[$day]->HoraireMatin;
                $string = substr($int, 0, 2).':'.substr($int, 2, 2).' à '.substr($int, 4, 2).':'.substr($int, 6, 2);
            } 
            else
            {
                $string= 'Fermé';
            }
        }
        else
        {
            if(isset($horaire[$day]->HoraireAM) && $horaire[$day]->HoraireAM != '')
            {
                $int =  $horaire[$day]->HoraireAM;
                $string = substr($int, 0, 2).':'.substr($int, 2, 2).' à '.substr($int, 4, 2).':'.substr($int, 6, 2);
            } 
            else
            {
                $string  =  'Fermé';
            }
        }
        return $string;
    }
        
}
?>