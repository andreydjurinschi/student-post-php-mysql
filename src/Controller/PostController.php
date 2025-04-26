<?php

namespace src\Controller;
use paginator\Paginator;
use src\Service\PostService;

require_once __DIR__ . '/../Service/PostService.php';
require_once __DIR__ . '/../Handler/PostHandler.php';
require_once __DIR__ . '/../utils/Paginator.php';
class PostController
{
    private $postService;
    private $paginator;
    public function __construct(){
        $this->postService = new PostService();
        $this->paginator = new Paginator();
    }

    public function getPosts(){
        $paginatedPosts = $this->paginator->createPagination();
        return $paginatedPosts['posts'];
    }
    public function getPaginationData()
    {
        return $this->paginator->createPagination();
    }


    public function getPost($id){
        $post = $this->postService->getPost($id);
        $_GET = [];
        return $post;
    }
    public function createPost(): array {
        return $this->postService->createPost($_POST);
    }

    public function updatePost(): array {
        return $this->postService->updatePost($_POST);
    }
    public function deletePost(): array {
        return $this->postService->deletePost($_POST);
    }
    public function getTwoPosts(array $posts): array {
        return array_slice($posts, -2, 2);
    }

}