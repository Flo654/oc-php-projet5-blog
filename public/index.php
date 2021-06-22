<?php

require_once '../vendor/autoload.php';


use App\controllers\Article;
use App\controllers\Auth;
use App\controllers\BackRender;
use App\controllers\Comment;
use App\controllers\FrontRender;
use App\controllers\Message;
use App\controllers\User;


session_start();



$frontRender = new FrontRender;
$backRender = new BackRender;

try {
    $submit = filter_input(INPUT_POST,('submit'));
    switch ($submit) {
        case 'signIn':
            (new Auth)->session();
            header("Refresh: 0");
            break;
        
        case 'logout':
            $auth = new Auth;
            $auth->logout(); 
            header("Refresh: 0");                
            break;

        case 'signUp':
            (new User)->createUser();
            break;
        
        case 'createArticle':
            
            $model = new Article();
            $model->createArticle();                    
            break;

        case 'createComment':                    
            $model = new Comment();
            $model->insertComment();                    
            break;

        case 'modifyArticle':                    
            $model = new Article();
            $model->updateArticle();                   
            break; 

        case 'deleteArticle':                    
            $model = new Article();
            $model->deleteArticle();                   
            break; 

        case 'validateComment':                                      
            $model = new Comment;
            $model->valideComment();                                  
            break;
        
        case 'deleteComment':                                      
            $model = new Comment;
            $model->deleteComment();                                  
            break;

        case 'postMessage':
            include '../credential.php' ;          
            $message = new Message;
            $message->sendMessage();
            break;
    }
} catch (Exception $e) {

    $errorMessage = $e->getMessage();
    $errorCode = $e->getCode();
    $frontRender->errorMessage($errorMessage, $errorCode); 

}


try {
    $uri = trim(filter_input(INPUT_SERVER,"REQUEST_URI"),'/');    
    $matchBlogUri = preg_match('%(blog/article-)([0-9]+)%', $uri, $matches);    
    if ($matchBlogUri){
        $matchUri = $matches;
        $articleId = $matches[2];
        $uri = 'blog/article-{id}';
        $frontRender->singlePost($articleId);
        return;
    }
    $matchArticleUri = preg_match('%(admin/update/article-)([0-9]+)%', $uri, $matches);
    if ($matchArticleUri){
        $matchUri = $matches;
        $articleId = $matches[2];
        $uri = 'admin/update/article-{id}';        
        return $backRender->modifyController($articleId);
    }
    if ($uri === '' || $uri === 'home'){        
        return $frontRender->display('home');
    }

    if ($uri ==='blog'){        
        return $frontRender->blog();
    }

    if ($uri === 'contact'){
        return $frontRender->display('contact');
    }
    if ($uri === 'checkModal'){
        $frontRender->display('checkModal');
        return;
    }
    if ($uri === 'createModal'){
        $frontRender->display('createModal');
        return;
    }
    if ($uri === 'admin'){
        $backRender->admin();
        return;
    }
    if ($uri === 'admin/article/create'){
        $backRender->article();
        return;
    }
    if ($uri === 'admin/postList'){
        $backRender->adminPostList();
        return;
    }
    if ($uri === 'admin/comments'){
        $backRender->commentController();
        return;
    }
    throw new Exception("Not Found !!", 404);
   

} catch (Exception $e) {

     $errorMessage = $e->getMessage();
     $errorCode = $e->getCode();
     $frontRender->errorMessage($errorMessage, $errorCode); 

}

