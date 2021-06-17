<?php
namespace App\controllers\superGlobals;


class  GetGlobals 
{
   
    public function setSession($item, $value){
            $_SESSION[$item] = $value;
        }


    public function getVariables($item = null){
        return ($item == null)? $_SESSION : $_SESSION[$item];
    }
    
   
   
}