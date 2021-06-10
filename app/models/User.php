<?php
namespace App\models;
use Exception;

class User extends Model
{
    protected $table = 'user';
    protected $pdo;
        
    /**
     * verify username and email are not already in database
     *
     * @param string $username
     * @param string $email
     * @return bool
     */
    private function isDatasAlreadyInDb(string $username, string $email) : bool
    {
        $sql = "SELECT * FROM user WHERE username = :username OR email = :email";
        $result = $this->pdo->prepare($sql);
        $result->execute(['username'=> $username, 'email'=> $email]);
        $data = $result->fetch();
        return (!$data['email'] and !$data['username']) ? true : false;
    }

    /**
     * create a new user in database
     *
     * @param string $username
     * @param string $email
     * @param string $password
     * @return void
     */
    public function create(string $username, string $email, string $password)
    {
        //we verify if username and email are already in database
        $result = $this->isDatasAlreadyInDb($username, $email);
        if (!$result) {
            throw new Exception("username or email already existing !!");
        }
        $sql = " INSERT INTO $this->table
        SET username = :username, 
            email = :email, 
            password = :password,
            isAdmin = 0,
            createdAt = NOW(),
            updatedAt = NOW()";
        $query = $this->pdo->prepare($sql);
        $query->execute(compact('username', 'email', 'password'));
    }

    /**
     * Update password user
     *
     * @param integer $itemId
     * @param string $password
     * @return void
     */
    public function updatePassword(int $itemId, string $password)
    {
        $tableId = $this->table . 'Id';
        $sql = " UPDATE $this->table 
        SET password = :password, 
        updatedAt = NOW()
        WHERE $tableId = $itemId ";
        $query = $this->pdo->prepare($sql);
        $query->execute(compact('password'));
    }
    
    /* public function updateIsAdmin(int $itemId, bool $isAdmin = 1)
    {
        $tableId = $this->table . 'Id';
        $sql = " UPDATE $this->table 
        SET isAdmin = :isAdmin, 
        updatedAt = NOW()
        WHERE $tableId = $itemId ";
        $query = $this->pdo->prepare($sql);
        $query->execute(compact('isAdmin'));
    } */
    
    public  function login(string $email, string $password) 
    {
          
        $sql = "SELECT * FROM user WHERE email = :email";
        $result = $this->pdo->prepare($sql);
        $result->execute(['email'=> $email]);
        $user = $result->fetch();
        // on verifie si le mail existe dans la base
        if(!$user)
        {
            throw new Exception("email inconnue", 401);
            return;                
        }
        //on verifie si le mot de passe est correct
        if (!password_verify($password, $user->password)) 
        {
            throw new Exception ("Mot de passe incorrect");
            return;
        }           
        return  $user;      
    }

    public function signUp (){

    }
}