<?php
namespace App\controllers;

use App\models\Article as ModelsArticle;
use App\models\Comment;
use Exception;

class Article 
{
    
    public function showArticles()
    {
        $modelArticle = new ModelsArticle();
        $articles = $modelArticle->findAll();
        if(!$articles){
            throw new Exception("impossible to load data !!");
        }
        return $articles;        
    }
    
    public function showOneArticle($articleId)
    {        
        $articleModel = new ModelsArticle();
        $commentModel = new Comment();
        //on recupere l'id de l'article passé en parametre dans l'url et on verifie q'un parametre id a été renseigné
        //$articleId = (int) filter_input(INPUT_GET, 'articleId');            
        if(!$articleId){
            throw new Exception("no post Id in parameter !!");
        }
        //on fait une requete à la base de donnée pour  vérifier qu'il existe bien un article avec cet id          
        $article = $articleModel->findById($articleId);
        if(!$article){
            throw new Exception("this post with this Id doesn't exist !!");
        }        
        //on recupère les commentaires associé à l'article qui ont été validé
        $sqlOption = " WHERE articleId = $articleId AND isValid = 1";            
        $comments = $commentModel->findAll($sqlOption);
        
        // require la vue pour afficher les articles
        return ['article'=>$article, 'comments'=>$comments];        
    }
    
    public function deleteArticle()
    {
        //recuperer l'id de l'article
        $articleId = (int) filter_input(INPUT_POST, 'articleId',FILTER_SANITIZE_STRING);
        $model = new ModelsArticle();
        $model->delete($articleId);
        // verifier que le user est admin
        //effacer le message
        //envoyer 
        
        
    }
    
    public function createArticle()
    {               
        //on recupere les données du formulaire        
        $author = filter_input(INPUT_POST, 'author');
        $title = filter_input(INPUT_POST, 'title');
        $chapo = filter_input(INPUT_POST, 'chapo');
        $content = filter_input(INPUT_POST, 'content');
        $categoryId = (int)filter_input(INPUT_POST, 'category');
        $readTime = (int)filter_input(INPUT_POST, 'readTime');
        $articleImage = filter_input(INPUT_POST, 'uploadImage');
        $imgUrl = "/assets/img/gallery/$articleImage";        
        //on verifie que les champs soient bien remplis       
        if (!$author || !$title || !$chapo || !$content || !$readTime || !$categoryId || !$imgUrl) {            
            throw new Exception( "please fill all the fields !!!");
        }            
        $articleModel = new ModelsArticle();
        $articleModel->create($author, $title, $chapo, $categoryId, $content, $readTime, $imgUrl);
    }
    
    public function updateArticle()
    {
        //on verifie que le user est admin
        //recuperer l'article à modifier
        $articleId = (int) filter_input(INPUT_POST, 'articleId'); 
                
        if(!$articleId){
            throw new Exception("no postId filled !!");
        } 
        //recupérer les champs modifier
        $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $chapo = filter_input(INPUT_POST, 'chapo');
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
        $categoryId = (int)filter_input(INPUT_POST, 'category');
        $readTime = (int)filter_input(INPUT_POST, 'readTime');
        $articleImage = filter_input(INPUT_POST, 'uploadImage', FILTER_SANITIZE_STRING);
        $imgUrl = "/assets/img/gallery/$articleImage";
         //on verifie que les champs soient bien remplis         
        if (!$author || !$title || !$chapo || !$content || !$readTime) {            
            throw new Exception( "please fill all the fields !! ");
        }       
        $articleModel = new ModelsArticle();
        $articleModel->update($articleId, $author, $title, $chapo, $categoryId, $content, $readTime, $imgUrl);
        
    }
}


