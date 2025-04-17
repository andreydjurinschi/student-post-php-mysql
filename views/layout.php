<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student blog - <?= isset($title) ? htmlspecialchars($title) : '' ?></title>
</head>
<body>
<header><h1>TEMPLATER WORKS</h1></header>
<main>
    <?php /** @var string $content */?>
    <?= $content ?>
</main>
</body>
</html>