<?php
namespace App\models;

class Category extends Model
{
    protected $table = 'category';
    /**
     * function that catches category name from category table to article table
     *
     * @param integer $articleId
     * @return array
     */
    public function getCategoryById(int $articleId)
    {

        $sql = "SELECT category.name FROM article INNER JOIN $this->table ON category.categoryId = article.categoryId WHERE articleId = :articleId ";
        $query = $this->pdo->prepare($sql);
        $query->execute(['articleId' => $articleId]);
        return $query->fetch();
    }
}