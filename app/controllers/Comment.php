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
            
            throw new Exception( "Veuillez remplir tous les champs ");
        }
        $commentModel = new ModelsComment();           
        $commentModel->create( $userId, $articleId, $content);
        
            
     
        
    } 

    // backend    

    //lister les commentaires à valider classé par article   
    public function getComments()
    {
        try {
            //on verifie que l'utilisateur est connecté
            //verifier que l'utilisateur qui efface le commentaire est admin
            $commentModel = new ModelsComment();
            $action = " ORDER BY articleId ASC";
            $comments = $commentModel->findAll($action);
            if(!$comments){
                throw new Exception("impossible de charger les données");
            }
        
            // require la vue pour afficher les commentaires
             
        } 
        catch (Exception $e){
            return $e->getMessage();
        }
        
    }
    //effacer un commentaire
    public function deleteComment()
    {
        
        try {
            //on verifie que l'utilisateur est connecté
            //verifier que l'utilisateur qui efface le commentaire est admin

            //on recupere l'id du commentaire passé en parametre dans l'url et on verifie q'un parametre id a été renseigné
            $commentId = (int) filter_input(INPUT_GET, 'commentId',FILTER_SANITIZE_STRING);
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
            $articleid = $comment['articleId'];
            //on efface le commentaire
            $commentModel->delete($commentId);

            //rediriger vers la page de l'article dont le commentaire a été effacé
            
            

        } 
        catch (Exception $e) {
            return $e->getMessage();
        }       
    }

    //valider un commentaire
    public function valideComment()
    {
        
        try {
            //on verifie que l'utilisateur est connecté
            //verifier que l'utilisateur qui efface le commentaire est admin

            //on recupere l'id du commentaire passé en parametre dans l'url et on verifie q'un parametre id a été renseigné
            $commentId = (int) filter_input(INPUT_GET, 'commentId',FILTER_SANITIZE_STRING);
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
            $articleid = $comment['articleId'];
            //on modifie le commentaire
            $commentModel->validComment($commentId);

            //rediriger vers la page de l'article dont le commentaire a été effacé
        } 
        catch (Exception $e) {
            return $e->getMessage();
        }       
    }

}