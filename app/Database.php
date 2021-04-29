<?php

namespace App;

use PDO;
use PDOException;
use Symfony\Component\Dotenv\Dotenv;


$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/../.env');

/**
 * connection to Database class
 */
class Database
{
    /**
     * database connection instance
     *
     * @var PDO
     */
    private static $instance = null;
    
    
   

    /**
     * function that connects to Database
     *
     * @return PDO
     */
    public static function getPDO() : PDO
    {
        if (self::$instance === null) {
            $envDatas = filter_var_array($_ENV, FILTER_SANITIZE_STRING);
            $dbName = $envDatas['DB_NAME'];
            $dbUser = $envDatas['DB_USER'];
            $dbPass = $envDatas['DB_PASS'];
            $dbHost = $envDatas['DB_HOST'];
                  
            try {
                               
                self::$instance = new PDO("mysql:dbname=$dbName;host=$dbHost", $dbUser, $dbPass );
                                
            } catch (PDOException $e) {

                $e->getMessage();
            }    
            
        }
        return self::$instance;
    }
}

