<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student blog - <?= isset($title) ? htmlspecialchars($title) : '' ?></title>
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
<header>
    <h2 class="app-name"><?= isset($pageName)? htmlspecialchars($pageName) : "Welcome!" ?></h2>
    <nav>
        <ul class="navbar">
            <li><a href="/">Main page</a></li>
            <li><a href="/posts">All posts</a></li>
            <li><a href="#">Create post</a></li>
        </ul>
    </nav>
</header>

<section>
</section>
<main>
    <div class="container">
        <?php /** @var string $content */?>
        <?= $content ?>
    </div>
</main>
<footer>
    <p>BLABLABLA</p>
</footer>
</body>
</html>