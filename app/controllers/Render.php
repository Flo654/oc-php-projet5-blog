<?php
namespace App\controllers;
use App\controllers\Article;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class  Render
{   

    private $twig ;
    
    public function __construct()
    {
        $this->twig = new Environment (new FilesystemLoader('../app/views'));
    }
   
    ////////////////////////////////////////////////////////
    ////////////////FRONT OFFICE ROUTE//////////////////////
    ////////////////////////////////////////////////////////

    public  function home($isConnected){        
        print_r( $this->twig->render('home.twig', ['isConnected'=> $isConnected]));
        return;
    }

    public function postList($isConnected){
        
        $model = new Article();
        $model2 = new Category();
        $articles = $model->showArticles();
        $categories = $model2->showCategory(); 
        print_r($this->twig->render('postList.twig', ['articles' => $articles,'categories' => $categories, 'isConnected'=> $isConnected]));
        return;
    }

    public function singlePost($isConnected, $articleId){
                
        $model = new Article();
        $model2 = new Category();        
        $article = $model->showOneArticle($articleId);
        $categories = $model2->showCategoryById($articleId);
        print_r($this->twig->render('singlePost.twig', ['article' => $article['article'],'comments' => $article['comments'], 'category' => $categories, 'isConnected'=> $isConnected]));
        return;
    }

    public function contact($isConnected){
        
        print_r($this->twig->render('contact.twig', ['isConnected' => $isConnected]));
        return;
    }

    /////////////////////////////////////////////////////////
    ////////////////BACK OFFICE ROUTE///////////////////////
    ////////////////////////////////////////////////////////


    public function admin($isConnected){
        
        $isAdmin = Auth::checkIfIsAdmin();
        (!$isAdmin) ? print_r($this->twig->render('404.twig', ['isConnected' => $isConnected ])) : print_r($this->twig->render('backlayout.twig', ['isConnected' => $isConnected , 'username' => $isAdmin['username'], 'isAdmin' => $isAdmin['isAdmin']]));
         return; 
    }

    public function article($isConnected){
        $model2 = new Category(); 
        $categories = $model2->showCategory();
        $isAdmin = Auth::checkIfIsAdmin();
        (!$isAdmin) ? print_r($this->twig->render('404.twig', ['isConnected' => $isConnected ])) : print_r($this->twig->render('createMessage.twig', ['categories' => $categories, 'isConnected' => $isConnected,'username' => $isAdmin['username'], 'isAdmin' => $isAdmin['isAdmin']]));
        return;
    }

    public function adminPostList($isConnected){
        $model = new Article();
        $articles = $model->showArticles();
        $isAdmin = Auth::checkIfIsAdmin();
        (!$isAdmin) ? print_r($this->twig->render('404.twig', ['isConnected' => $isConnected ])) : print_r($this->twig->render('adminPostList.twig', ['articles' => $articles, 'isConnected'=> $isConnected, 'username' => $isAdmin['username']]));
        return;
    }

    public function modifyController($isConnected, $articleId)
    {
        $model = new Article();
        $model2 = new Category();        
        $article = $model->showOneArticle($articleId);
        $categories = $model2->showCategory();
        $isAdmin = Auth::checkIfIsAdmin();
        (!$isAdmin) ? print_r($this->twig->render('404.twig', ['isConnected' => $isConnected ])) : print_r($this->twig->render('modifyPost.twig', ['article' => $article['article'],'categories' => $categories, 'isConnected'=> $isConnected, 'username' => $isAdmin['username'], 'isAdmin' => $isAdmin['isAdmin']]));
        return;
    }
    
}



