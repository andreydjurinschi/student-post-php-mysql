<?php

use app\Core\Router;
use app\Core\Templater;

require_once __DIR__ . '/HttpMethods.php';
require_once __DIR__ . '/Router.php';
require_once __DIR__ . '/../Templater.php';


$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router = new Router();
$template = new Templater('layout', __DIR__ . '/../../../views');


$router->addRoute(GET, '/', function() use ($template) {
    $template->render('templates/mainPage', ['title' => 'Home']);
});

$router->addRoute(GET, '/posts', function() use ($template) {
    $template->render('templates/posts/allPosts', ['title' => 'Posts']);
});

$router->dispatch($path);



