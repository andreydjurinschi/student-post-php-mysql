<?php
require_once __DIR__ . "/../app/router/router-initializer.php";
require_once __DIR__ . "/../src/template/Template.php";

use template\Template;

$template = new Template(__DIR__ . "/../src/pages/", ['pageName'=>'Main page']);
$content = [
    ['name' => 'Julia',
    'surname' => 'Brown',
    'age' => 23],
    ['name' => 'Julia',
        'surname' => 'Brown',
        'age' => 23],
];

try {
    echo $template->render('index-tml.php',['content'=>$content, 'template'=> $template] );
} catch (Exception $e) {
    echo $e->getMessage();
}