<?php
use src\Controller\PostController;
require_once __DIR__ . "/../../../src/Controller/PostController.php";
$postController = new PostController();
$posts = $postController->getPosts();
?>

<h1>HELLO TO ALL POSTS PAGE</h1>
<div class="container">
    <h1 style="color: #444;">All Posts</h1>
    <a class="btn-create" href="/posts/create" style="display: inline-block; padding: 10px 20px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 5px; transition: background-color 0.3s ease;">Create new post</a>
    <div class="post-container">
        <?php foreach($posts as $post) { ?>
            <div class="post-card">
                <h2> <?= $post['post_title'] ?></h2>
                <p> <strong>Content: </strong><?= $post['post_description'] ?></p>
                <p><strong>Date:</strong> <?= $post['post_gif'] ?></p>
            </div>
        <?php } ?>
    </div>W
