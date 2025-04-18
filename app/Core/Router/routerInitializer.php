<?php

use app\Core\Router;
use app\Core\Templater;

require_once __DIR__ . '/HttpMethods.php';
require_once __DIR__ . '/Router.php';
require_once __DIR__ . '/../Templater.php';
require_once __DIR__ . '/../../../src/Controller/PostController.php';
require_once __DIR__ . '/../../../src/Controller/CategoryController.php';
use src\Controller\PostController;
use src\Controller\CategoryController;



$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router = new Router();
$template = new Templater('layout', __DIR__ . '/../../../views');


$router->addRoute(GET, '/', function() use ($template) {
    $template->render('templates/mainPage', ['title' => 'Home']);
});

$router->addRoute(GET, '/posts', function() use ($template) {
    $template->render('templates/posts/allPosts', ['title' => 'Posts']);
});

$router->addRoute(GET, '/posts/view', function () use ($template) {
    if(isset($_GET['post_id'])){
        $template->render('templates/posts/edit-post', ['title' => 'Post']);
    }
});

$router->addRoute(GET, '/posts/create', function () use ($template) {
    $template->render('templates/posts/create-post', ['title' => 'Create Post']);
});

$router->addRoute(POST, '/posts/create', function () use ($template) {
    $controller = new PostController();
    $message = [];

    // Обрабатываем POST запрос на создание поста
    if ($_SERVER['REQUEST_METHOD'] === POST && isset($_POST['action']) && $_POST['action'] === 'createPost') {
        // Получаем результат создания поста
        $message = $controller->createPost();

        // Если пост успешно создан, перенаправляем на страницу всех постов
        if (key($message) === 'success') {
            header('Location: /posts');
            exit;
        }
    }

    // Получаем категории для выпадающего списка
    $categoryController = new CategoryController();
    $categories = $categoryController->getCategories();

    // Отображаем форму создания поста с возможными ошибками
    $template->render('templates/posts/allPosts', [
    ]);
});




$router->dispatch($path);



