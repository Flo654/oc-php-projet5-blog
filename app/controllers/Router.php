<?php
namespace App\controllers;

use App\controllers\Auth;
use App\controllers\Render;


class Router
{   
    
    public function get($path, $viewName)
    {
        $uri = filter_input(INPUT_SERVER,"REQUEST_URI") ?? '/home';

        if($path == '/blog/article-:id' ){
            $regexUri = preg_match('%(/blog/article-)([0-9]+)%', $uri, $matches);
            if ($regexUri){$matchUri = $matches;}      
            $regexPath = preg_match('%(/blog/article-)(\:id)%', $path, $matches);       
            if ($regexPath){$matchPath = $matches;}        
            if ($regexUri && $regexPath){
                if($matchUri[1] == $matchPath[1]){
                    $path=$uri;
                    $articleId = (int) $matchUri[2];               
                }
            }
        }

        if($path == '/backArticle-:id' ){
            $regexUri = preg_match('%(/backArticle-)([0-9]+)%', $uri, $matches);
            if ($regexUri){$matchUri = $matches;}      
            $regexPath = preg_match('%(/backArticle-)(\:id)%', $path, $matches);       
            if ($regexPath){$matchPath = $matches;}        
            if ($regexUri && $regexPath) {
                if ($matchUri[1] == $matchPath[1]) {
                    $path=$uri;
                    $articleId = (int) $matchUri[2];
                }
            }
        }  
        
        if($path == '/deleteArticle-:id' ){
            $regexUri = preg_match('%(/deleteArticle-)([0-9]+)%', $uri, $matches);
            if ($regexUri){$matchUri = $matches;}      
            $regexPath = preg_match('%(/deleteArticle-)(\:id)%', $path, $matches);       
            if ($regexPath){$matchPath = $matches;}        
            if ($regexUri && $regexPath) {
                if ($matchUri[1] == $matchPath[1]) {
                    $path=$uri;
                    $articleId = (int) $matchUri[2];
                }
            }
        }

        if ($path == $uri) {
           
            $render = new Render();
            switch ($viewName) {
                ///////////////////////////////////////////
                //////////////FRONT ROUTES/////////////////
                ///////////////////////////////////////////
                
                case 'homeController':                                        
                    $render->home();                    
                    break;

                case 'postListController':
                    $render->postList();                    
                    break;                    

                case 'singlePostController':
                    $render->singlePost($articleId);
                    break;
                
                case 'contactController':
                    $render->contact();
                    break;


                ///////////////////////////////////////////
                //////////////BACK ROUTES/////////////////
                ///////////////////////////////////////////

                case 'adminController':
                    $render->admin();
                    break;

                case 'articleController':
                    $render->article();
                    break;
                
                case 'adminPostList':
                    $render->adminPostList();
                    break;

                case 'modifyController':
                    
                    $render->modifyController($articleId);
                    break;

                case 'deleteController':
                    $model = new Article();
                    $model->deleteArticle($articleId);
                    header("Location: /postList");   
                default:
                
                    break;
            }
            
        }
    }

    public function post($path, $viewName=null)
    {

        $submit = filter_input(INPUT_POST,('submit'));
        if (!$submit){return;}
        if ($submit === $path){

            switch ($submit) {
                case 'signIn':
                    Auth::auth(); 
                    header("Refresh: 0");                
                    break;
                     
                case 'logout':
                    Auth::logout(); 
                    header("Refresh: 0");                
                    break;
    
                case 'signUp':
                    $model = new User();
                    $model->createUser();
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
                    
                default:
                   
                    break;
            }
            

        }
        return;
        
    }
}