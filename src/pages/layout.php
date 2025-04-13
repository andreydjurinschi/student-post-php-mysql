<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/src/assets/style.css">
    <title><?= $template->getPageParams('pageName') ?></title>
</head>
<body>
    <header class="header-block">
        <h1 class="title" style="margin-bottom: 10px">WEB PAGE</h1>
        <nav>
            <ul>
                <li><a href="#">Main</a></li>
                <li><a href="/posts">All posts</a></li>
                <li><a href="#">Create post</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </nav>
    </header>
        <main>
            <div class="content-block">
                <?= $pageContent ?>
            </div>
        </main>
</body>
</html>
