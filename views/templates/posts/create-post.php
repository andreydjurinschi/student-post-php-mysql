<?php

use src\Controller\CategoryController;
require_once __DIR__ . "/../../../src/Controller/CategoryController.php";
$categoryController = new CategoryController();
$categories = $categoryController->getCategories();
?>

<h1>Create post</h1>

<form method="POST">
    <input type="hidden" name="action" value="createPost">
    <label for="title">Title</label>
    <input type="text" id="title" name="post_title" placeholder="Input title...">
    <label for="description">DESC</label>
    <textarea id="description" name="post_description" placeholder="Input title..."></textarea>
    <label for="post_gif">Gif</label>
    <input type="text" id="post_gif" name="post_gif" placeholder="Input path to gif">
    <label for="cat_id">CATEGORY</label>
    <select name="cat_id" id="cat_id">
        <option value="">SELECT A CATEGORY</option>
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
    <input type="submit">
</form>
