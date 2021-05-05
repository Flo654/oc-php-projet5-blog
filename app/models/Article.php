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
    public function create(int $userId, int $categoryId, string $title, string $chapo, string $content, int $readTime)
    {
        
        $sql = " INSERT INTO $this->table
        SET userId = :userId, 
            categoryId = :categoryId,
            title = :title,
            chapo = :chapo,
            content = :content,
            readTime = :readTime,
            isPublished = 0,
            createdAt = NOW(),
            updatedAt = NOW()";
        $query = $this->pdo->prepare($sql);
        $query->execute(compact('userId', 'categoryId', 'title','chapo','content','readTime'));
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
    public function update(int $articleId, int $categoryId, string $title, string $chapo, string $content, int $readTime )
    {
        $tableId = $this->table . 'Id';
        $sql = " UPDATE $this->table 
        SET categoryId = :categoryId,
            title = :title,
            chapo = :chapo,
            content = :content,
            readTime = :readTime,
            updatedAt = NOW()
        WHERE $tableId = $articleId ";
        $query = $this->pdo->prepare($sql);
        $query->execute(compact('categoryId', 'title', 'chapo', 'content', 'readTime'));
    } 
    
    /**
     * function that catches author name from table user to table article
     *
     * @param integer $articleId 
     * @return array
     */
    public function getAuthor(int $articleId) :array
    {

        $sql = "SELECT user.nom, user.prenom FROM article INNER JOIN user ON user.userId = article.userId WHERE articleId = :articleId ";
        $query = $this->pdo->prepare($sql);
        $query->execute(['articleId' => $articleId]);
        return $query->fetch();
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