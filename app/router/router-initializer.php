<?php

use router\Router;

require_once __DIR__ . "/Router.php";
require_once __DIR__ . "/HttpMethods.php";
require_once __DIR__ . "/../../src/template/Template.php";

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = str_replace('/public', '', $path);


$router = new Router();

$router->addRoute(GET, '/', function () {
    require_once __DIR__ . "/../../public/index.php";
});



$router->dispatch($path);


