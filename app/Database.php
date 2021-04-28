<?php

namespace App;

use PDO;
use PDOException;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(dirname(__DIR__, 1) . '/.env');

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
            extract($_ENV);        
            try {

                self::$instance = new PDO("mysql:dbname=$DB_NAME;host=$DB_HOST", $DB_USER, $DB_PASS );
                echo'Congrats, You are connected to your database :)';

            } catch (PDOException $e) {

                echo'Hum, something wrong happens, connection has failed :(  '. $e->getMessage();
            }    
            
        }
        return self::$instance;
    }
}

