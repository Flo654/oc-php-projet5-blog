<?php
namespace App\models;

class Comment extends Model
{
    protected $table = 'comment';
    


    public function findAll(string $action = "")
    {
        $sql = "SELECT comment.commentId, comment.userId, comment.articleId, comment.content, comment.isValid, comment.updatedAt,comment.createdAt, user.username FROM comment INNER JOIN user ON comment.userId = user.userId $action ";
        $result = $this->pdo->query($sql);
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
        $query->execute(compact('userId','articleId','content'));
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
        WHERE $tableId = comment:commentId ";
        $query = $this->pdo->prepare($sql);
        $query->execute(compact('commentId'));
    }
    
    /* public function getCommentsbyArticleId(int $articleId, string $options=null)
    {
        $sql = " SELECT * FROM $this->table WHERE articleId = :articleId $options"; 
        $query = $this->pdo->prepare($sql);
        $query->execute(['articleId' => $articleId]);
        return $query->fetchAll();
        
    } */

    //recuperer le nom du user (jointure)
    public function getUsername()
    {
        
    }

}