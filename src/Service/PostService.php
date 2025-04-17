<?php

namespace src\Service;
require_once __DIR__ . "/../Repository/PostRepository.php";
use \src\Repository\PostRepository;
class PostService
{
    private $repository;
    public function __construct(){
        $this->repository = new PostRepository();
    }

    public function getPosts(){
        return $this->repository->getPosts();
    }

    public function getPost($id){
        return $this->repository->getPost($id);
    }
}