<?php
namespace App\controllers;

use App\models\Comment as ModelsComment;
use Exception;

class Comment {

    /**
     * function that insert comment linked with article into database 
     *
     * @return void
     */
    public function insertComment()
    {       
        //on verifie que le user est connect
        if (! $_SESSION['isConnected']){
            throw new Exception("user not connected");            
        }
        //on recupere le userId dans $_SESSION
        $userId = (int) $_SESSION['user']->userId;
        $articleId = (int)filter_input(INPUT_POST, 'articleId', FILTER_SANITIZE_NUMBER_INT);
        $content = filter_input(INPUT_POST, 'comment');               
        //on verifie que tous les champs sont bien remplis
        if ( !$content || !$articleId) {            
            throw new Exception( "please, fill all the fields ");
        }
        $commentModel = new ModelsComment();           
        $commentModel->create( $userId, $articleId, $content);
        return;
             
    }    

       
    public function getComments()
    {
        
        //verifier que l'utilisateur qui efface le commentaire est admin
        $commentModel = new ModelsComment();
        $action = " ORDER BY articleId ASC";
        $comments = $commentModel->findAll($action);
        if(!$comments){
            throw new Exception("impossible to load data");
        }       
    }
    
    public function deleteComment()
    {
        
        //on recupere l'id du commentaire passé en parametre dans l'url et on verifie q'un parametre id a été renseigné
        $commentId = (int) filter_input(INPUT_POST, 'commentId',FILTER_SANITIZE_STRING);
        if (!$commentId){
            throw new Exception('le parametre du commentaire n\'a pas été renseigné !!');
        }
        $commentModel = new ModelsComment();

        //on vérifie que l'id pointe vers un commentaire existant
        $comment = $commentModel->findById($commentId);
        if (!$comment){
            throw new Exception("il n'y a pas de commentaire qui correspond à cet Id");
        }
        //on recupere l'id de l'article avant d'effacer le commentaire
        //$articleid = $comment['articleId'];
        //on efface le commentaire
        $commentModel->delete($commentId);     
    }

    
    public function commentsList()
    {
        $model = new ModelsComment;
        $comments = $model->findCommentsToValidate();
        return $comments;
    }


    public function valideComment()
    {
        //on verifie que l'utilisateur est connecté
        //verifier que l'utilisateur qui efface le commentaire est admin

        //on recupere l'id du commentaire passé en parametre dans l'url et on verifie q'un parametre id a été renseigné
        $commentId = (int) filter_input(INPUT_POST, 'commentId'); 
        
        if (!$commentId){
            throw new Exception('le parametre du commentaire n\'a pas été renseigné !!');
        }
        $commentModel = new ModelsComment();

        //on vérifie que l'id pointe vers un commentaire existant
        $comment = $commentModel->findById($commentId);
        if (!$comment){
            throw new Exception("il n'y a pas de commentaire qui correspond à cet Id");
        }
        //on recupere l'id de l'article avant de valider le commentaire
        //$articleid = $comment['articleId'];
        //on modifie le commentaire
        $commentModel->validComment($commentId);

        //rediriger vers la page de l'article dont le commentaire a été effacé              
    }

}