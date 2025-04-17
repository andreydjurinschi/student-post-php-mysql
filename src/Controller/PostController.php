<?php

namespace src\Controller;
use src\Service\PostService;

require_once __DIR__ . '/../Service/PostService.php';
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
        return $this->postService->getPost($id);
    }
}