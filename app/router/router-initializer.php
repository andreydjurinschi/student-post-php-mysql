<?php

use router\Router;

require_once __DIR__ . "/Router.php";
require_once __DIR__ . "/HttpMethods.php";

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = str_replace('/public', '', $path);


$router = new Router();

$router->addRoute(GET, '/', function () {
    require_once __DIR__ . "/../../views/posts.php";
});

$router->addRoute(GET, '/about', function () {
    require_once __DIR__ . "/../../views/edit-post.php";
});

$router->dispatch($path);


