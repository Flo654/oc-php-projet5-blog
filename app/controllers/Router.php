<?php
namespace App\controllers;

use App\controllers\Auth;
use App\controllers\Render;


class Router
{   
    
    public function get($path, $viewName, $isConnected)
    {
        $uri = filter_input(INPUT_SERVER,"REQUEST_URI") ?? '/home';

        if($path == '/article-:id' ){
            $regexUri = preg_match('%(/article-)([0-9]+)%', $uri, $matches);
            if ($regexUri){$matchUri = $matches;}      
            $regexPath = preg_match('%(/article-)(\:id)%', $path, $matches);       
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
                    $render->home($isConnected);                    
                    break;

                case 'postListController':
                    $render->postList($isConnected);                    
                    break;                    

                case 'singlePostController':
                    $render->singlePost($isConnected, $articleId);
                    break;
                
                case 'contactController':
                    $render->contact($isConnected);
                    break;


                ///////////////////////////////////////////
                //////////////BACK ROUTES/////////////////
                ///////////////////////////////////////////

                case 'adminController':
                    $render->admin($isConnected);
                    break;

                case 'articleController':
                    $render->article($isConnected);
                    break;
                
                case 'adminPostList':
                    $render->adminPostList($isConnected);
                    break;

                case 'modifyController':
                    $render->modifyController($isConnected,$articleId);
                    break;

                case 'deleteController':
                    $model = new Article();
                    $model->deleteArticle($articleId);
                    header("Location: /home");   
                default:
                
                    break;
            }
            
        }
    }

    public function post($path, $viewName)
    {

        $submit = filter_input(INPUT_POST,('submit'));
        $path;
        
        if (!$submit){return;}
        if ($submit === $path){

            switch ($submit) {
                case 'signIn':
                    $auth = Auth::auth(); 
                    header("Refresh: 0");                
                    break;
                     
                case 'logout':
                    $auth = Auth::logout(); 
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