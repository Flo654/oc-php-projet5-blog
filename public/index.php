<?php
require_once '../vendor/autoload.php';
use App\controllers\Router;

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


session_start();
//var_dump($_SESSION['user']->username);exit;
$isConnected = (!empty($_SESSION['isConnected'])) ? $_SESSION['isConnected'] : false;
