<?php
namespace App\models;

class Article extends Model
{
    protected $table = 'article';
        
    /**
     * function that creates a new article in database
     *
     * @param integer $userId
     * @param integer $categoryId
     * @param string $title
     * @param string $chapo
     * @param string $content
     * @param integer $readTime
     * @return void
     */
    public function create(  string $author,string $title, string $chapo, string $content, int $readTime)
    {
        $sql = " INSERT INTO $this->table
        SET  
            author = :author
            title = :title,
            chapo = :chapo,
            content = :content,
            readTime = :readTime,
            createdAt = NOW(),
            updatedAt = NOW()";
        $query = $this->pdo->prepare($sql);
        $query->execute(compact('author', 'title','chapo','content','readTime'));
    }

    /**
     * function that updates an article
     *
     * @param integer $articleId
     * @param integer $categoryId
     * @param string $title
     * @param string $chapo
     * @param string $content
     * @param integer $readTime
     * @return void
     */
    public function update(int $articleId, string $author, string $title, string $chapo, string $content, int $readTime )
    {
        $tableId = $this->table . 'Id';
        $sql = " UPDATE $this->table 
        SET author = :author,
            title = :title,
            chapo = :chapo,
            content = :content,
            readTime = :readTime,
            updatedAt = NOW()
        WHERE $tableId = $articleId ";
        $query = $this->pdo->prepare($sql);
        $query->execute(compact( 'author', 'title', 'chapo', 'content', 'readTime'));
    } 
    
    

    /**
     * function that catches category name from category table to article table
     *
     * @param integer $articleId
     * @return array
     */
    public function getCategory(int $articleId): array
    {

        $sql = "SELECT category.name FROM article INNER JOIN category ON category.categoryId = article.categoryId WHERE articleId = :articleId ";
        $query = $this->pdo->prepare($sql);
        $query->execute(['articleId' => $articleId]);
        return $query->fetch();

    }    
}