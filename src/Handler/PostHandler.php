<?php

use src\Controller\CategoryController;
use src\Controller\PostController;

require_once __DIR__ . "/../Controller/PostController.php";
require_once __DIR__ . "/../Controller/CategoryController.php";

class PostHandler
{
    private $postController;

    public function __construct()
    {
        $this->postController = new PostController();
    }

    public function handlePost()
    {
        $message = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'createPost') {
            $message = $this->postController->createPost();
            if (key($message) === 'success') {
                $_POST = [];
                header("Location: /posts");
                exit;
            }
        }
            return $message;
    }

    public function handlePostUPD()
    {
        $message = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'updatePost') {
            $message = $this->postController->updatePost();
            if (key($message) === 'success') {
                $_POST = [];
                header("Location: /posts");
                exit;
            }
        }
        return $message;
    }

    public function handlePostDEL()
    {
        $message = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'deletePost') {
            $message = $this->postController->deletePost();
            if (key($message) === 'success') {
                $_POST = [];
                header("Location: /posts");
                exit;
            }
        }
        return $message;
    }






















/*    public function handlePost(){
        $message = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'createPost'){
            $message = $this->postController->createPost();
            if(key($message) === 'success'){
                $_POST = [];
                header("Location: /posts");
                exit;
            }
        }
        return $message;
    }*/
}