<?php
use src\Controller\PostController;
require_once __DIR__ . "/../../src/Controller/PostController.php";
$postController = new PostController();
$posts = $postController->getPosts();
$post = $postController->getPost(1);
?>

<div class="container">
    <h2>About us</h2>
    <p>Welcome to our blog! We are a group of students passionate about sharing our thoughts and experiences with the world. Our blog covers a variety of topics, including technology, lifestyle, travel, and more. We hope you enjoy reading our posts as much as we enjoy writing them!</p>
</div>

<div class="post-container">
    <h2>Latest Posts</h2>
    <?php foreach ($posts as $post): ?>
        <div class="post">
            <h3><?= htmlspecialchars($post['post_title']) ?></h3>
            <p><?= htmlspecialchars($post['post_description']) ?></p>
            <p><?= htmlspecialchars($post['post_gif']) ?></p>
        </div>
    <?php endforeach; ?>
    <h2>OPA</h2>
    <?= $post['post_title'] ?>
    <?= $post['post_description'] ?>
</div>
