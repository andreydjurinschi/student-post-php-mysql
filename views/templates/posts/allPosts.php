<?php
use src\Controller\PostController;
use src\Controller\CategoryController;
require_once __DIR__ . "/../../../src/Controller/PostController.php";
require_once __DIR__ . "/../../../src/Controller/CategoryController.php";
$postController = new PostController();
$categoryController = new CategoryController();
$paginationData = $postController->getPaginationData();
$posts = $paginationData['posts'];
$totalPages = $paginationData['totalPages'];
$currentPage = $paginationData['currentPage'];
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
                <br>
                <br>
        <a href="/posts/view?post_id=<?= $post['post_id'] ?>" class="btn-edit">Edit</a>
        <a href="/posts/view/delete?post_id=<?= $post['post_id'] ?>" class="btn-edit">Delete</a>
            </div>
        <?php } ?>
        <br>
        <div class="pagination" style="display: flex; justify-content: center; margin-top: 20px;">
            <?php if($currentPage > 1): ?>
                <a href="?page=<?= $currentPage - 1 ?>" style="margin: 0 5px; padding: 10px 15px; background-color: #333; color: #fff; text-decoration: none; border-radius: 5px;">Previous</a>
            <?php endif; ?>

            <?php for($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>" <?= $i == $currentPage ? 'class="active"' : '' ?> style="margin: 0 5px; padding: 10px 15px; background-color: <?= $i == $currentPage ? '#28a745' : '#333' ?>; color: #fff; text-decoration: none; border-radius: 5px;"><?= $i ?></a>
            <?php endfor; ?>

            <?php if($currentPage < $totalPages): ?>
                <a href="?page=<?= $currentPage + 1 ?>" style="margin: 0 5px; padding: 10px 15px; background-color: #333; color: #fff; text-decoration: none; border-radius: 5px;">Next</a>
            <?php endif; ?>
        </div>
    </div>
