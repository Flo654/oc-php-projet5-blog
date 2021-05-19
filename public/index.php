<?php

use App\controllers\Article as ControllersArticle;
use App\models\Comment;

require_once '../vendor/autoload.php';
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

/* $model = new ControllersArticle();
$model->showArticles(); */

