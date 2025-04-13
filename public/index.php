<?php
require_once __DIR__ . "/../app/router/router-initializer.php";
require_once __DIR__ . "/../src/template/Template.php";

use template\Template;

$template = new Template(__DIR__ . "/../src/pages/", ['pageName' => "HOME"]);

try {
    echo $template->render('index-tml.php',['template'=> $template] );
} catch (Exception $e) {
    echo $e->getMessage();
}