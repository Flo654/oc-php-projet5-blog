<?php

namespace App\controllers;

use App\models\User;
use Exception;

class Auth
{ 
   private function setCookies($item, $value, $time = NULL)
   {
        setcookie($item,$value,$time);
   }
    
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
              
        $this->setCookies('user', $user->username);
        $this->setCookies('isAdmin', $user->isAdmin);
        $this->setCookies('userId', $user->userId);
        $this->setCookies('isConnected', true);        
        return; 
    }


    public function logout()
    {
        $this->setCookies("user", "", time() - 3600);
        $this->setCookies("isAdmin", "", time() - 3600);
        $this->setCookies("isConnected", "", time() - 3600);
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

