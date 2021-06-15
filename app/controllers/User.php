<?php
namespace App\controllers;

use App\models\User as ModelsUser;
use Exception;

class User {

    private $userModel = new ModelsUser();
    
    ////////////////////////////////////////
    //////////// FRONT /////////////////////
    ////////////////////////////////////////
        
    // creer un utilisateur
    public function createUser()
    {
        
        try {
            //recuperer les données du formulaire en POST        
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            //verifier les données du formulaire
            if ( !$password || !$email || $username) {
               
                throw new Exception( "Veuillez remplir tous les champs ");
            }
            
            //hacher le mot de passe
            $hachPassword = password_hash($password, PASSWORD_DEFAULT);

            //creer l'utilisateur
            $userModel = new ModelsUser();
            $userModel->create($username,$email,$hachPassword);
            // afficher le message de reussite
            // diriger vers la page de connection
        } catch ( Exception $e) {

            return $e->getMessage();
        }
        

    }
        
    ////////////////////////////////////////
    ///////////// BACK /////////////////////
    ////////////////////////////////////////
    
    private function checkingData(int $userId)
    {
        // verifier que l'userId à été passé en parametre
        if(!$userId){
            throw new Exception("l'id du User n'a pas été passé en parametre");
        }
        // verifier que cet user existe
        $user = $this->userModel->findById($userId);
        if(!$user){
            throw new Exception("le User avec cet id n'existe pas'");
        }
        return $user;
    }
    // afficher les utilisateurs
    public function getUsers()
    {
        //verifier que l'utilisateur est admin
        // afficher la liste des utilisateurs
        try {
            $modelUser = new ModelsUser();
            $users = $modelUser->findAll();
            if(!$users){
                throw new Exception("impossible de charger les données");
            }
            
            // require la vue pour afficher les articles
             
        } 
        catch (Exception $e){
            return $e->getMessage();
        }


    }

    // afficher un utilisateur
    public function getUser()
    {
        try {
            //vérifier que l'utilisateur est admin
            // recuperer l'id du user en GET
             $userId = (int) filter_input(INPUT_GET, 'userId');
            /*// verifier que l'userId à été passé en parametre
            if(!$userId){
                throw new Exception("l'id du User n'a pas été passé en parametre");
            } 
            // verifier que le user existe
            $userModel = new ModelsUser();
            $user = $userModel->findById($userId);
            if(!$user){
                throw new Exception("le User avec cet id n'existe pas'");
            } */
            $user = $this->checkingData($userId);
            // require la vue pour afficher le user

        } catch (Exception $e) {

            return $e->getMessage();
        }
        
    }

    // suprimmer un utilisateur
    public function deleteUser()
    {
        try {
            //vérifier que l'utilisateur est admin
            // recuperer l'id du user
            $userId = (int) filter_input(INPUT_GET, 'userId');
            // verifier que l'userId à été passé en parametre
           /*  if(!$userId){
                throw new Exception("l'id du User n'a pas été passé en parametre");
            }
            // verifier que cet user existe
            $userModel = new ModelsUser();
            $user = $userModel->findById($userId);
            if(!$user){
                throw new Exception("le User avec cet id n'existe pas'");
            } */
            $this->checkingData($userId);
            // supprimer le user
            $this->userModel->delete($userId);

            //afficher message suppression reussi
            // rediriger vers la liste des users
        } catch (Exception $e) {
            
            return $e->getMessage();
        }
        
    }

    // modifier un utilisateur (passer un user en admin)
    public function modifyUser()
    {
        try {
            //vérifier que l'utilisateur est admin
            // recuperer l'id du user
            $userId = (int) filter_input(INPUT_GET, 'userId');
           /*  // verifier que l'userId à été passé en parametre
            if(!$userId){
                throw new Exception("l'id du User n'a pas été passé en parametre");
            }
            // verifier que cet user existe
            $userModel = new ModelsUser();
            $user = $userModel->findById($userId);
            if(!$user){
                throw new Exception("le User avec cet id n'existe pas'");
            } */
            $this->checkingData($userId);
            // passer le user en admin
            $this->userModel->updateIsAdmin($userId);

            //afficher message de modification reussi
            // rediriger vers la liste des users
        } catch (Exception $e) {
            
            return $e->getMessage();
        }
    }
}