<?php

use src\Controller\CategoryController;
use src\Controller\PostController;
require_once __DIR__ . "/../../../src/Controller/CategoryController.php";
require_once __DIR__ . "/../../../src/Controller/PostController.php";
$categoryController = new CategoryController();
$categories = $categoryController->getCategories();
$postController = new PostController();
$post = $postController->getPost($_GET['post_id']);
?>

<h1>Edit post</h1>
<img src="<?= $post['post_gif'] ?>" alt="">
<form method="POST">
    <input type="hidden" name="action" value="updatePost">
    <input type="hidden" name="post_id" value="<?=$post['post_id']?>">
    <label for="title">Title</label>
    <input type="text" id="title" name="post_title" placeholder="Input title..." value="<?= htmlspecialchars($post['post_title']) ?>">
    <label for="description">DESC</label>
    <textarea id="description" name="post_description" placeholder="Input title..."><?= htmlspecialchars($post['post_description']) ?></textarea>
    <label for="post_gif">Gif</label>
    <input type="text" id="post_gif" name="post_gif" placeholder="Input path to gif" value="<?= $post['post_gif'] ?>">
    <label for="cat_id">CATEGORY</label>
    <select name="cat_id" id="cat_id">
        <?php foreach($categories as $category): ?>
            <option value="<?= htmlspecialchars($category['cat_id']) ?>"><?= htmlspecialchars($category['cat_name']) ?></option>
        <?php endforeach; ?>
    </select>
    <?php
    if(!empty($message)) {
        foreach ($message as $key => $value): ?>
            <?= htmlspecialchars($key) ?>: <?= htmlspecialchars($value) ?><br>
        <?php endforeach;
    }
    ?>
    <input type="submit" value="Edit">
</form>
