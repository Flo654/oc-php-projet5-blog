<?php

require_once '../vendor/autoload.php';


use App\controllers\Article;
use App\controllers\Auth;
use App\controllers\BackRender;
use App\controllers\Comment;
use App\controllers\FrontRender;
use App\controllers\Message;
use App\controllers\User;



$frontRender = new FrontRender;
$backRender = new BackRender;

//POST routes
try {
    $submit = filter_input(INPUT_POST,('submit'));
    switch ($submit) {
        
        case 'signIn':
            (new Auth)->auth();
            header("Refresh: 0");
            break;
        
        case 'logout':
            (new Auth)->logout(); 
            header("Refresh: 0");                
            break;

        case 'signUp':
            (new User)->createUser();
            break;
        
        case 'createArticle':
            (new Article)->createArticle();                    
            break;

        case 'createComment':                    
            (new Comment)->insertComment();                    
            break;

        case 'modifyArticle':                    
            (new Article)->updateArticle();                   
            break; 

        case 'deleteArticle':                    
            (new Article)->deleteArticle();                   
            break; 

        case 'validateComment':                                      
            (new Comment)->valideComment();                                  
            break;
        
        case 'deleteComment':                                      
            (new Comment)->deleteComment();                                  
            break;

        case 'postMessage':
            include '../credential.php' ;          
            (new Message)->sendMessage();
            break;
    }
} catch (Exception $e) {

    $errorMessage = $e->getMessage();
    $errorCode = $e->getCode();
    $frontRender->errorMessage($errorMessage, $errorCode); 

}

// GET routes
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
        return $frontRender->display('createModal');
    }

    if ($uri === 'articleConfirmMessage'){
        return $frontRender->display('articleConfirmMessage');
    }

    if ($uri === 'admin'){
        return $backRender->admin();
    }

    if ($uri === 'admin/article/create'){
        return $backRender->article();
    }

    if ($uri === 'admin/postList'){
        return  $backRender->adminPostList();
    }

    if ($uri === 'admin/comments'){
        return $backRender->commentController();
    }

    throw new Exception("Not Found !!", 404);
   

} catch (Exception $e) {

     $errorMessage = $e->getMessage();
     $errorCode = $e->getCode();
     $frontRender->errorMessage($errorMessage, $errorCode); 

}

