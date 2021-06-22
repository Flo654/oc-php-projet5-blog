<?php
namespace App\controllers;
use App\controllers\Article;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class  FrontRender
{   

    private $twig ;
    private $auth;
    private $isAdmin;
    
    public function __construct()
    {
        $this->twig = new Environment (new FilesystemLoader(['../app/views/layout', '../app/views/components/modals components','../app/views/components/errors components','../app/views/front', '../app/views/front/components']));
        $this->auth = new Auth();
        $this->isAdmin = $this->auth->checkIfIsAdmin();
    }
   
    ////////////////////////////////////////////////////////
    ////////////////FRONT OFFICE ROUTE//////////////////////
    ////////////////////////////////////////////////////////

    private function printe($data){
        print_r($data);
        return;
    }
   
    public function display($page){
        
        $this->printe($this->twig->render("$page.twig", ['isConnected'=> $this->isAdmin['isConnected'], 'username' => $this->isAdmin['username'], 'isAdmin' => $this->isAdmin['isAdmin']]));
        return;
    }
    public  function errorPage()
    {        
        $this->printe( $this->twig->render('404.twig', ['isConnected'=> $this->isAdmin['isConnected'] ]));
        return;
    }

    public function errorMessage($errorMessage, $errorCode)
    {
        $this->printe( $this->twig->render('errorPage.twig', ['isConnected'=> $this->isAdmin['isConnected'], 'errorMessage' => $errorMessage, 'errorCode' => $errorCode ]));
        return;
    }

    public function blog()
    {
        
        $model = new Article();
        $model2 = new Category();
        $articles = $model->showArticles();
        $categories = $model2->showCategory(); 
        $this->printe($this->twig->render('postList.twig', ['articles' => $articles,'categories' => $categories,'isConnected'=> $this->isAdmin['isConnected'], 'username' => $this->isAdmin['username'], 'isAdmin' => $this->isAdmin['isAdmin']]));
        return;
    }

    public function singlePost($articleId)
    {                
        $model = new Article();
        $model2 = new Category();        
        $article = $model->showOneArticle($articleId);
        $categories = $model2->showCategoryById($articleId);
        $this->printe($this->twig->render('singlePost.twig', ['article' => $article['article'],'comments' => $article['comments'], 'category' => $categories, 'isConnected'=> $this->isAdmin['isConnected'], 'username' => $this->isAdmin['username'], 'isAdmin' => $this->isAdmin['isAdmin']]));
        return;
    }


}



