<?php
namespace App\models;

use App\Database;

abstract class Model
{
    /**
     * table name to do SQL requests
     *
     * @var string table 
     */
    protected $table ;
    /**
     * instance of database connection 
     *
     * @var \PDO
     */
    protected $pdo;
    
    /**
     * connection to db
     */
    public function __construct()
    {
        $this->pdo = Database::getPDO();
    }
    
    /**
     * function that finds all items
     *
     * @param string $action are SQL options
     * @return array
     */
    public function findAll(string $action = "") : array
    {
        $sql = "SELECT * FROM $this->table $action ";
        $result = $this->pdo->query($sql);
        return  $result->fetchAll();
    }
    
    /**
     * function that find an item by id
     *
     * @param integer $itemId 
     * @return array
     */
    public function findById(int $itemId): array
    {
        $tableId = $this->table . 'Id';
        $sql = "SELECT * FROM $this->table WHERE $tableId = :id";
        $result = $this->pdo->prepare($sql);
        $result->execute(['id' => $itemId]);
        return $result->fetch();
    }
    
    /**
     * function that delete an item by id
     *
     * @param integer $itemId
     * @return void
     */
    public function delete(int $itemId)
    {
        $tableId = $this->table . 'Id';
        $sql = "DELETE FROM $this->table WHERE $tableId = :id";
        $result = $this->pdo->prepare($sql);
        $result->execute(['id' => $itemId]);
    }    
}