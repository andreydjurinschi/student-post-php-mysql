<?php
use src\Controller\PostController;
require_once __DIR__ . "/../../../src/Controller/PostController.php";
$postController = new PostController();
$post = $postController->getPost($_GET['post_id']);

echo $post['post_title'];
echo $post['post_description'];
