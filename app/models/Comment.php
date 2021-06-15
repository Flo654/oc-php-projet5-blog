<?php
namespace App\models;
use Exception;


class Comment extends Model
{
    protected $table = 'comment';
    


    public function findAll(string $action = "")
    {
        $sql = "SELECT $this->table.commentId, $this->table.userId, $this->table.articleId, $this->table.content, $this->table.isValid, $this->table.updatedAt,$this->table.createdAt, user.username FROM $this->table INNER JOIN user ON $this->table.userId = user.userId $action ";
        $result = $this->pdo->query($sql);
        if (!$result) {
            throw new Exception("impossible to do the request !!");            
        }
        return  $result->fetchAll();
    }

    public function findCommentsToValidate(string $action = "")
    {
        $action = "WHERE $this->table.isValid = 0";
        $sql = "SELECT $this->table.commentId, $this->table.userId, $this->table.articleId, $this->table.content, $this->table.isValid, $this->table.updatedAt,$this->table.createdAt, article.title FROM $this->table INNER JOIN article ON $this->table.articleId = article.articleId $action ";
        $result = $this->pdo->query($sql);
        if (!$result) {
            throw new Exception("impossible to do the request !!");            
        }
        return  $result->fetchAll();
    }


    /**
     * function that create a comment in article
     *
     * @param integer $articleId
     * @param string $author
     * @param string $authorEmail
     * @param string $content
     * @return void
     */
    public function create( int $userId ,int $articleId, string $content)
    {
        
        $sql = " INSERT INTO $this->table
        SET userId = :userId,
            articleId = :articleId, 
            content = :content,
            isValid = 0,
            createdAt = NOW(),
            updatedAt = NOW()";
        $query = $this->pdo->prepare($sql);
        $result = $query->execute(compact('userId','articleId','content'));
        if (!$result) {
            throw new Exception("impossible to do the request !!");            
        }
    }

    /**
     * function that Valid à comment
     *
     * @param integer $commentId
     * @param string $content
     * @return void
     */
    public function validComment(int $commentId)
    {
        $tableId = $this->table . 'Id';
        $sql = " UPDATE $this->table 
        SET isValid = 1,
            updatedAt = NOW()
        WHERE $tableId = :commentId ";
        $query = $this->pdo->prepare($sql);
        $result = $query->execute(compact('commentId'));
        if (!$result) {
            throw new Exception("impossible to do the request !!");            
        }
    }
    

}