<?php
use src\Controller\PostController;
use src\Controller\CategoryController;
require_once __DIR__ . "/../../../src/Controller/PostController.php";
require_once __DIR__ . "/../../../src/Controller/CategoryController.php";
$postController = new PostController();
$categoryController = new CategoryController();
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
                <p> <strong>Category: </strong>
                    <?php
                    $category = $categoryController->getCategory($post['cat_id']);
                    echo $category ? htmlspecialchars($category['cat_name']) : 'Unknown';
                    ?>
                </p>

                <img class="stu-gif" src="<?= $post['post_gif']?>" alt="">
        <a href="/posts/view?post_id=<?= $post['post_id'] ?>" class="btn-edit">Edit</a>
            </div>
        <?php } ?>
    </div>
