<?php

namespace App\controllers;

use App\controllers\superGlobals\GetGlobals;
use App\models\User;
use App\SuperGlobals;
use Exception;

class Auth
{ 
    private static function instance()
    {
        return new GetGlobals;
    }
    
    private function auth()
    {        
        $password = filter_input(INPUT_POST,"password"); 
        $email = filter_input(INPUT_POST,"email");
        if (!$password && !$email){return;}
        $userModel = new User();
        $user = $userModel->login($email, $password);
        if(!$user){
            throw new Exception("impossible to load data !!");
        }

        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        return $user ?? null;
    }

    public function session () {
        $user = $this->auth();   
        if ($user == null){return;}
        self::instance()->setSession('user', $user);
        self::instance()->setSession('isConnected', true);
        
        return self::instance()->getVariables();
    }

    public function logout()
    {
        if(session_status() !== PHP_SESSION_NONE)
        {
            session_destroy();
        }
        
        return false;
    }


    public function checkIfIsAdmin()
    {
        
        $test = self::instance()->getVariables();
        if ($test){
            $username = $test['user']->username;
            $isAdmin = $test['user']->isAdmin;
            $isConnected = $test['isConnected'];
            
        }
        
        return (!$test) ?  false : ['username' => $username, 'isAdmin' => $isAdmin, 'isConnected' => $isConnected];
    }

}

