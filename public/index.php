<?php
require_once '../vendor/autoload.php';
use App\controllers\Router;

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


session_start();


$router = new Router;

try {
    ////////////////////////////////////////////////////////
    /////////////////////// ROUTES//////////////////////////
    ////////////////////////////////////////////////////////

    $router->post('signIn', 'loginController');
    $router->post('signUp', 'createUserController');
    $router->post('logout', 'createUserController');
    $router->post('createArticle', 'CreateArticleController');
    $router->post('createComment', 'CreateCommentController');
    $router->post('modifyArticle', 'modifyCommentController');

    ////////////////FRONT OFFICE ROUTE//////////////////////

    $router->get('/home', 'homeController');
    $router->get('/blog', 'postListController');
    $router->get('/blog/article-:id', 'singlePostController');
    $router->get('/contact', 'contactController');

    ////////////////BACK OFFICE ROUTE///////////////////////
    ////////////////////////////////////////////////////////

    $router->get('/article', 'articleController');
    $router->get('/admin', 'adminController');
    $router->get('/postList', 'adminPostList');
    $router->get('/backArticle-:id', 'modifyController');
    $router->get('/deleteArticle-:id', 'deleteController');
} catch (Exception $e) {
    echo"une erreur a été levée: ", $e->getMessage();
}

