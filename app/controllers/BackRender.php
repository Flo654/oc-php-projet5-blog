<?php
namespace App\controllers;
use App\controllers\Article;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class  BackRender
{   

    private $twig;
    private $auth;
    private $isAdmin;
    
    public function __construct()
    {
        $this->twig = new Environment (new FilesystemLoader(['../app/views/layout','../app/views/back', '../app/views/components', '../app/views/components/modals components','../app/views/components/errors components',]));
        $this->auth = new Auth();
        $this->isAdmin = $this->auth->getCookiesData();
    }
   
 
    private function printe($data){
        print_r($data);
        return;
    }
   
    /////////////////////////////////////////////////////////
    ////////////////BACK OFFICE ROUTE///////////////////////
    ////////////////////////////////////////////////////////


    public function admin()
    {                
       
        (!$this->isAdmin['isAdmin']) ? $this->printe($this->twig->render('404.twig', ['isConnected'=> $this->isAdmin['isConnected'] ])) : $this->printe($this->twig->render('backhome.twig', ['isConnected'=> $this->isAdmin['isConnected'] , 'username' => $this->isAdmin['username'], 'isAdmin' => $this->isAdmin['isAdmin']]));
         return; 
    }

    public function article()
    {
        $model2 = new Category(); 
        $categories = $model2->showCategory();
       
        (!$this->isAdmin['isAdmin'] ) ? $this->printe($this->twig->render('404.twig', ['isConnected'=> $this->isAdmin['isConnected'] ])) : $this->printe($this->twig->render('createMessage.twig', ['categories' => $categories, 'isConnected'=> $this->isAdmin['isConnected'],'username' => $this->isAdmin['username'], 'isAdmin' => $this->isAdmin['isAdmin']]));
        return;
    }

    public function adminPostList()
    {
        $model = new Article();
        $articles = $model->showArticles();
        (!$this->isAdmin['isAdmin']) ? $this->printe($this->twig->render('404.twig', ['isConnected'=> $this->isAdmin['isConnected']])) : $this->printe($this->twig->render('adminPostList.twig', ['articles' => $articles, 'isConnected'=> $this->isAdmin['isConnected'], 'username' => $this->isAdmin['username']]));
        return;
    }

    public function commentController()
    {
        $model = new Comment;
        $comments = $model->commentsList();
        (!$this->isAdmin['isAdmin']) ? $this->printe($this->twig->render('404.twig', ['isConnected'=> $this->isAdmin['isConnected'] ])) : $this->printe($this->twig->render('commentList.twig', ['isConnected'=> $this->isAdmin['isConnected'] , 'username' => $this->isAdmin['username'], 'isAdmin' => $this->isAdmin['isAdmin'], 'comments' => $comments]));
         return; 
    }

    public function modifyController($articleId)
    {
        $model = new Article();
        $model2 = new Category();        
        $article = $model->showOneArticle($articleId);
        $categories = $model2->showCategory();
        (!$this->isAdmin['isAdmin']) ? $this->printe($this->twig->render('404.twig', ['isConnected'=> $this->isAdmin['isConnected']])) : $this->printe($this->twig->render('modifyPost.twig', ['article' => $article['article'],'categories' => $categories, 'isConnected'=> $this->isAdmin['isConnected'], 'username' => $this->isAdmin['username'], 'isAdmin' => $this->isAdmin['isAdmin']]));
        return;
    }
    
}
