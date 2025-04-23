<?php

namespace src\Controller;
use src\Service\PostService;

require_once __DIR__ . '/../Service/PostService.php';
require_once __DIR__ . '/../Handler/PostHandler.php';
class PostController
{
    private $postService;
    public function __construct(){
        $this->postService = new PostService();
    }

    public function getPosts(){
        return $this->postService->getPosts();
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

}