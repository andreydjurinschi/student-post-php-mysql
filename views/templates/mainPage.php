<?php
require_once __DIR__ . '/../../src/Controller/PostController.php';
require_once __DIR__ . '/../../src/Controller/CategoryController.php';
use src\Controller\PostController;
use src\Controller\CategoryController;

$postController = new PostController();
$categoryController = new CategoryController();
$posts = $postController->getPosts();
$two = $postController->getTwoPosts($posts);
?>

<div class="container">
    <h2>About us</h2>
    <p>Welcome to our blog! We are a group of students passionate about sharing our thoughts and experiences with the world. Our blog covers a variety of topics,</p>
    <p>including technology, lifestyle, travel, and more. We hope you enjoy reading our posts as much as we enjoy writing them!</p>
</div>

<div class="container">
    <h2>Latest Posts</h2>
    <p>Check out our latest posts and stay updated with the latest news and trends in the student community.</p>
    <?php foreach($two as $post) { ?>
        <div class="post-card">
            <h2> <?= $post['post_title'] ?></h2>
            <p> <strong>Content: </strong><?= $post['post_description'] ?></p>
            <p> <strong>Category: </strong>
                <?php
                $category = $categoryController->getCategory($post['cat_id']);
                echo $category ? htmlspecialchars($category['cat_name']) : 'Unknown';
                ?>
            </p>

            <img class="stu-gif" src="<?= $post['post_gif']?>" alt="">
        </div>
    <?php } ?>
    </div>

