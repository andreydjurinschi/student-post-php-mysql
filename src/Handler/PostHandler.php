<?php

use src\Controller\PostController;

require_once __DIR__ . "/../Controller/PostController.php";

$postController = new PostController();
$message = array();

if(isset($_POST["action"]) && $_POST["action"] === "createPost"){
    $message = $postController->createPost();
    if(key($message) === "success"){
        $_POST = [];
        exit;
    }
}