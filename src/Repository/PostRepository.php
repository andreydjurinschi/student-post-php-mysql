<?php

namespace src\Repository;
require_once __DIR__ . "/../../config/DatabaseConnector.php";
use config\DatabaseConnector;
use PDO;
use PDOException;

class PostRepository{
    private $connection;

    public function __construct(){
        $db = new DatabaseConnector('db', 'user', 'pass');
        $db->createConnection();
        $this->connection = $db->getConnection();
    }

    public function getPosts() : array{
        try {
            $statement = $this->connection->prepare("select * from posts");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function getPost(int $id){
        $statement = $this->connection->prepare("select * from posts where post_id = ?");
        $statement->execute([$id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /***
     * @param int|null $cat_id
     * @param string $post_title
     * @param string $post_description
     * @param string $post_gif
     * @return bool
     */
    public function createPost(string $post_title, string $post_description,string $post_gif,  ?int $cat_id = null): bool
    {
        $statement = $this->connection->prepare("insert into posts(post_title, post_description, cat_id, post_gif) values (?, ?, ?, ?)");
        $statement->execute([$post_title, $post_description,  $cat_id, $post_gif]);
        return (bool)$statement;
    }

    public function editPost(string $post_title, string $post_description,string $post_gif, int $post_id, ?int $cat_id = null){
        $statement = $this->connection->prepare("update posts set post_title = ?, post_description = ?, cat_id = ?, post_gif = ? where post_id = ?");
        $statement->execute([$post_title, $post_description, $cat_id, $post_gif, $post_id]);
        return (bool)$statement;
    }




}
