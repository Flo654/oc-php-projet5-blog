<?php
namespace App\controllers;
use App\controllers\Article;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class  Render
{   

    private $twig ;
    private $isAdmin;
    
    public function __construct()
    {
        $this->twig = new Environment (new FilesystemLoader('../app/views'));
        $this->isAdmin = Auth::checkIfIsAdmin();
    }
   
    ////////////////////////////////////////////////////////
    ////////////////FRONT OFFICE ROUTE//////////////////////
    ////////////////////////////////////////////////////////

    public  function home()
    {        
       print_r( $this->twig->render('home.twig', ['isConnected'=> $this->isAdmin['isConnected'], 'username' => $this->isAdmin['username'], 'isAdmin' => $this->isAdmin['isAdmin']]));
        return;
    }

    public  function errorPage()
    {        
       print_r( $this->twig->render('404.twig', ['isConnected'=> $this->isAdmin['isConnected'] ]));
        return;
    }

    public function errorMessage($errorMessage, $errorCode)
    {
        print_r( $this->twig->render('errorPage.twig', ['isConnected'=> $this->isAdmin['isConnected'], 'errorMessage' => $errorMessage, 'errorCode' => $errorCode ]));
        return;
    }

    public function blog()
    {
        
        $model = new Article();
        $model2 = new Category();
        $articles = $model->showArticles();
        $categories = $model2->showCategory(); 
        print_r($this->twig->render('postList.twig', ['articles' => $articles,'categories' => $categories,'isConnected'=> $this->isAdmin['isConnected'], 'username' => $this->isAdmin['username'], 'isAdmin' => $this->isAdmin['isAdmin']]));
        return;
    }

    public function singlePost($articleId)
    {                
        $model = new Article();
        $model2 = new Category();        
        $article = $model->showOneArticle($articleId);
        $categories = $model2->showCategoryById($articleId);
        print_r($this->twig->render('singlePost.twig', ['article' => $article['article'],'comments' => $article['comments'], 'category' => $categories, 'isConnected'=> $this->isAdmin['isConnected'], 'username' => $this->isAdmin['username'], 'isAdmin' => $this->isAdmin['isAdmin']]));
        return;
    }

    public function contact()
    {
        print_r($this->twig->render('contact.twig', ['isConnected'=> $this->isAdmin['isConnected'], 'username' => $this->isAdmin['username'], 'isAdmin' => $this->isAdmin['isAdmin']]));
        return;
    }

    /////////////////////////////////////////////////////////
    ////////////////BACK OFFICE ROUTE///////////////////////
    ////////////////////////////////////////////////////////


    public function admin()
    {                
        (!$this->isAdmin) ? print_r($this->twig->render('404.twig', ['isConnected'=> $this->isAdmin['isConnected'] ])) : print_r($this->twig->render('backlayout.twig', ['isConnected'=> $this->isAdmin['isConnected'] , 'username' => $this->isAdmin['username'], 'isAdmin' => $this->isAdmin['isAdmin']]));
         return; 
    }

    public function article()
    {
        $model2 = new Category(); 
        $categories = $model2->showCategory();
        (!$this->isAdmin) ? print_r($this->twig->render('404.twig', ['isConnected'=> $this->isAdmin['isConnected'] ])) : print_r($this->twig->render('createMessage.twig', ['categories' => $categories, 'isConnected'=> $this->isAdmin['isConnected'],'username' => $this->isAdmin['username'], 'isAdmin' => $this->isAdmin['isAdmin']]));
        return;
    }

    public function adminPostList()
    {
        $model = new Article();
        $articles = $model->showArticles();
        (!$this->isAdmin) ? print_r($this->twig->render('404.twig', ['isConnected'=> $this->isAdmin['isConnected']])) : print_r($this->twig->render('adminPostList.twig', ['articles' => $articles, 'isConnected'=> $this->isAdmin['isConnected'], 'username' => $this->isAdmin['username']]));
        return;
    }

    public function commentController()
    {
        $model = new Comment;
        $comments = $model->commentsList();
        (!$this->isAdmin) ? print_r($this->twig->render('404.twig', ['isConnected'=> $this->isAdmin['isConnected'] ])) : print_r($this->twig->render('commentList.twig', ['isConnected'=> $this->isAdmin['isConnected'] , 'username' => $this->isAdmin['username'], 'isAdmin' => $this->isAdmin['isAdmin'], 'comments' => $comments]));
         return; 
    }

    public function modifyController($articleId)
    {
        $model = new Article();
        $model2 = new Category();        
        $article = $model->showOneArticle($articleId);
        $categories = $model2->showCategory();
        (!$this->isAdmin) ? print_r($this->twig->render('404.twig', ['isConnected'=> $this->isAdmin['isConnected']])) : print_r($this->twig->render('modifyPost.twig', ['article' => $article['article'],'categories' => $categories, 'isConnected'=> $this->isAdmin['isConnected'], 'username' => $this->isAdmin['username'], 'isAdmin' => $this->isAdmin['isAdmin']]));
        return;
    }
    
}



