<?php

namespace App\controllers;

use App\models\User;
use Exception;

class Auth
{
    public static function auth()
    {        
        $password = filter_input(INPUT_POST,"password"); 
        $email = filter_input(INPUT_POST,"email");
        $userModel = new User();
        $user = $userModel->login($email, $password);
        if(!$user){
            throw new Exception("impossible to load data !!");
        }

        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }                
        $_SESSION['user']= $user;
        $_SESSION['isConnected'] = true;       
    }

    public static function logout()
    {
        if(session_status() !== PHP_SESSION_NONE)
        {
            session_destroy();
        }
        
        return false;
    }


    public static function checkIfIsAdmin()
    {
        if (empty($_SESSION)){
        return false;
        }
        $username = $_SESSION['user']->username;
        $isAdmin =  $_SESSION['user']->isAdmin;
        $isConnected = $_SESSION['isConnected']; 
        return (!$isConnected) ?  false : ['username' => $username, 'isAdmin' => $isAdmin, 'isConnected' => $isConnected];
    }

}

