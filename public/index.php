<?php
require_once '../vendor/autoload.php';

use App\controllers\Render;
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
    $router->post('modifyArticle', 'modifyCommentController');//modify
    $router->post('validateComment', 'validateComment');//modify
    $router->post('deleteComment', 'deleteComment');//delete

    ////////////////FRONT OFFICE ROUTE//////////////////////

    $router->get('/home', 'homeController');
    $router->get('/blog', 'postListController');
    $router->get('/blog/article-:id', 'singlePostController');
    $router->get('/contact', 'contactController');

    ////////////////BACK OFFICE ROUTE///////////////////////
    ////////////////////////////////////////////////////////

    $router->get('/admin', 'adminController');
    $router->get('/admin/article/create', 'articleController');    
    $router->get('/admin/comments', 'commentsController');
    $router->get('/admin/postList', 'adminPostList');
    $router->get('/backArticle-:id', 'modifyController');//modify
    $router->get('/deleteArticle-:id', 'deleteController');//delete

} catch (Exception $e) {

     $errorMessage = $e->getMessage();
     $errorCode = $e->getCode();
     $render = new Render;
     $render->errorMessage($errorMessage, $errorCode); 

}

