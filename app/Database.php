<?php

namespace App;

use PDO;
use PDOException;

include '../config.php';


/**
 * connection to Database class
 */
abstract class Database
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
     * @return PDO|string
     */
    public static  function getPDO()
    {
        if (self::$instance === null) {
           // $envDatas = filter_var_array($_ENV, FILTER_SANITIZE_STRING);
            $dbName = DBNAME;//$envDatas['DB_NAME'];
            $dbUser = DBUSER;//$envDatas['DB_USER'];
            $dbPass = DBPASS;//$envDatas['DB_PASS'];
            $dbHost = DBHOST;//$envDatas['DB_HOST'];
                  
            try {
                               
                self::$instance = new PDO("mysql:dbname=$dbName;host=$dbHost", $dbUser, $dbPass );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            } catch (PDOException $e) {

                return $e->getMessage();
            }    
            
        }
        return self::$instance;
    }
}

