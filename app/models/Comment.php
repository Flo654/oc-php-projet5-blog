<?php
namespace App\models;

class Comment extends Model
{
    protected $table = 'comment';
    
    /**
     * function that create a comment in article
     *
     * @param integer $articleId
     * @param string $author
     * @param string $authorEmail
     * @param string $content
     * @return void
     */
    public function create(int $articleId, string $author, string $authorEmail, string $content)
    {
        
        $sql = " INSERT INTO $this->table
        SET articleId = :articleId, 
            author = :author,
            authorEmail = :authorEmail,
            content = :content,
            isValid = 0,
            createdAt = NOW(),
            updatedAt = NOW()";
        $query = $this->pdo->prepare($sql);
        $query->execute(compact('articleId', 'author', 'authorEmail','content'));
    }

    /**
     * function that update a comment from an article
     *
     * @param integer $commentId
     * @param string $content
     * @return void
     */
    public function update(int $commentId,  string $content )
    {
        $tableId = $this->table . 'Id';
        $sql = " UPDATE $this->table 
        SET content = :content,
            isValid = 0,
            updatedAt = NOW()
        WHERE $tableId = $commentId ";
        $query = $this->pdo->prepare($sql);
        $query->execute(compact('content'));
    }         
}