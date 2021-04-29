<?php

namespace App;

use PDO;
use PDOException;


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
     * function that collect .env datas without using $_ENV
     *
     * @param int $info represents the key of the array that contains data
     * @return string
     */
    private static function getEnvData($info) : string
    {
        $path = dirname(__DIR__, 1) . '/.env';
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $data = preg_split("/[=]/", $lines[$info]);
        $donne = array_key_last($data);
        $result = $data[$donne];
        return $result;        
    }

    /**
     * function that connects to Database
     *
     * @return PDO
     */
    public static function getPDO() : PDO
    {
        if (self::$instance === null) {

           $dbName = self::getEnvData(0);
           $dbUser = self::getEnvData(1);
           $dbPass = self::getEnvData(2);
           $dbHost =self::getEnvData(3);
                  
            try {
                
                
                self::$instance = new PDO("mysql:dbname=$dbName;host=$dbHost", $dbUser, $dbPass );
                

            } catch (PDOException $e) {

                $e->getMessage();
            }    
            
        }
        return self::$instance;
    }
}

