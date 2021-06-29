<?php

namespace App\controllers;

use App\controllers\superGlobals\GetGlobals;
use App\models\User;
use App\SuperGlobals;
use Exception;

class Auth
{ 
   
    
    public function auth()
    {        
        $password = filter_input(INPUT_POST,"password"); 
        $email = filter_input(INPUT_POST,"email");
        if (!$password && !$email){return;}
        $userModel = new User();
        $user = $userModel->login($email, $password);
        if(!$user){
            throw new Exception("impossible to load data !!");
        }
        
        setcookie('user', $user->username);
        setcookie('isAdmin', $user->isAdmin);
        setcookie('isConnected', true);
        return; 
    }


    public function logout()
    {
        setcookie("user", "", time() - 3600);
        setcookie("isAdmin", "", time() - 3600);
        setcookie("isConnected", "", time() - 3600);
        return ;
    }


    public function getCookiesData()
    {
            $username =  filter_input(INPUT_COOKIE, 'user');
            $isAdmin = filter_input(INPUT_COOKIE, 'isAdmin');
            $isConnected = filter_input(INPUT_COOKIE, 'isConnected');    
        
        return  ['username' => $username, 'isAdmin' => $isAdmin, 'isConnected' => $isConnected];
    }

}

