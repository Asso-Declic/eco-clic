<?php

class RightHelper
{
    public static function IsRightEnabled($right) {
       
        if (in_array($right, SessionHelper::GetCurrentUser()->Droits)) 
        {
            return true; 
        }
        else
        {
            return false; 
        }
    }
}
?>