<?php

namespace paginator;
use config\DatabaseConnector;
use PDO;

require_once __DIR__ .'/../../config/DatabaseConnector.php';
class Paginator
{
    private $connection;

    public function __construct()
    {
        $this->connection = new DatabaseConnector('db', 'user', 'pass');
        $this->connection->createConnection();
        $this->connection = $this->connection->getConnection();
    }

    public function createPagination(){
        if(isset($_GET['page'])){
            $pageNumber = $_GET['page'];
        }else{
            $pageNumber = 1;
        }

        $limit = 3; // по 6 постов на стр хочу
        $currentPage = ($pageNumber - 1) * $limit;
        $countQuery = "select count(*) as total FROM posts";
        $stmt = $this->connection->prepare($countQuery);
        $stmt->execute();
        $totalPosts = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        $totalPages = ceil($totalPosts / $limit);
        $postsQuery = "SELECT * FROM posts LIMIT {$currentPage}, {$limit}";
        $stmt = $this->connection->prepare($postsQuery);
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return [
            'posts' => $posts,
            'totalPages' => $totalPages,
            'currentPage' => $pageNumber
        ];

}
}