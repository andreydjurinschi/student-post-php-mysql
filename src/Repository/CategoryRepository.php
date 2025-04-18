<?php

namespace src\Repository;
require_once __DIR__ . '/../../config/DatabaseConnector.php';
use config\DatabaseConnector;
use PDO;

class CategoryRepository
{
    private $connection;

    public function __construct(){
        $db = new DatabaseConnector('db', 'user', 'pass');
        $db->createConnection();
        $this->connection = $db->getConnection();
    }

    public function getCategories(){
        $sql = "select * from categories";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}