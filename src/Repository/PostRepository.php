<?php

namespace src\Repository;
require_once __DIR__ . "/../../config/DatabaseConnector.php";
use config\DatabaseConnector;
use PDO;

class PostRepository{
    private $connection;

    public function __construct(){
        $db = new DatabaseConnector('db', 'user', 'pass');
        $db->createConnection();
        $this->connection = $db->getConnection();
    }

    public function getPosts() : array{
        $statement = $this->connection->prepare("select * from posts");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPost(int $id){
        $statement = $this->connection->prepare("select * from posts where post_id = ?");
        $statement->execute([$id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
