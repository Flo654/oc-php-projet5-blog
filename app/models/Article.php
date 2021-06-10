<?php
namespace App\models;
use Exception;
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
    public function create(  string $author,string $title, string $chapo, $categoryId, string $content, int $readTime, $imgUrl)
    {
        $sql = " INSERT INTO $this->table
        SET author = :author,
            title = :title,
            chapo = :chapo,
            categoryId = :categoryId,
            content = :content,
            readTime = :readTime,
            imgUrl = :imgUrl,
            createdAt = NOW(),
            updatedAt = NOW()";
        $query = $this->pdo->prepare($sql);
        $query->execute(compact('author', 'title', 'chapo', 'categoryId', 'content', 'readTime', 'imgUrl'));
        
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
    public function update(int $articleId, string $author,string $title, string $chapo, $categoryId, string $content, int $readTime, $imgUrl )
    {
        $tableId = $this->table . 'Id';
        $sql = " UPDATE $this->table 
        SET author = :author,
            title = :title,
            chapo = :chapo,
            categoryId = :categoryId,
            content = :content,
            readTime = :readTime,
            imgUrl = :imgUrl,
            updatedAt = NOW()
        WHERE articleId = :articleId ";
        $query = $this->pdo->prepare($sql);
        $qer = $query->execute( ['articleId' => $articleId, 'author'=> $author, 'title' => $title, 'chapo' => $chapo, 'categoryId' => $categoryId, 'content' => $content,  'readTime' => $readTime, 'imgUrl' => $imgUrl]);
        if(!$qer){
            throw new Exception("Error Processing Request", 1);
            
        }
    } 
    
   /**
     * function that finds all items
     *
     * @param string $action are SQL options
     * @return array
     */
    public function findAll(string $action = "") 
    {
        $sql = "SELECT article.articleId, article.title, article.author, article.chapo, article.content, article.readTime, article.imgUrl, article.createdAt, article.updatedAt, category.name FROM $this->table INNER JOIN category ON article.categoryId = category.categoryId $action ";
        $result = $this->pdo->query($sql);
        return  $result->fetchAll();
    }

    

    public function getUsername(int $articleId): array
    {

        $sql = "SELECT category.name FROM article INNER JOIN category ON category.categoryId = article.categoryId WHERE articleId = :articleId ";
        $query = $this->pdo->prepare($sql);
        $query->execute(['articleId' => $articleId]);
        return $query->fetch();

    }
    
    
}