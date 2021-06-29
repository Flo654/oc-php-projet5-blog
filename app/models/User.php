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
        return (!$data) ? true : false;
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
        if(!$result){
            throw new Exception("username or email already existing, please change !!");            
        }
        $sql = " INSERT INTO $this->table
        SET username = :username, 
            email = :email, 
            password = :password,
            isAdmin = 0,
            createdAt = NOW(),
            updatedAt = NOW()";
        $query = $this->pdo->prepare($sql);
        $result = $query->execute(compact('username', 'email', 'password'));
        if (!$result) {
            throw new Exception("impossible to do this request !!");            
        }
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
        $result = $query->execute(compact('password'));
        if (!$result) {
            throw new Exception("impossible to do the request !!");            
        }
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
            throw new Exception("your email is not the good one, please fill a good email",404);
            return;                
        }
        //on verifie si le mot de passe est correct
        if (!password_verify($password, $user->password)) 
        {
            throw new Exception ("your password is incorrect", 404);
            return;
        }           
        return  $user;      
    }

}