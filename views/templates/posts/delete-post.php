<h1>Create post</h1>
<form method="POST">
    <input type="hidden" name="action" value="deletePost">
    <input type="hidden" name="post_id" value="<?= $_GET['post_id'] ?? 0 ?>">
    <input type="submit" value="Delete">
    <?php
    if(!empty($message)) {
        foreach ($message as $key => $value): ?>
            <?= htmlspecialchars($key) ?>: <?= htmlspecialchars($value) ?><br>
        <?php endforeach;
    }
    ?>
</form>

