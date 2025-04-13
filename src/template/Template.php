<?php

namespace template;
class Template
{
    private $pathToPage;
    private $params = [];
    private $layout = 'layout.php';

    public function __construct($pathToPage, $params = []){
        $this->pathToPage = $pathToPage;
        $this->params = $params;
    }

    public function get($key){
        return $this->params[$key];
    }

    public function render($templateName, $params = []){
        if(!file_exists($this->pathToPage . $templateName)){
            throw new \Exception("Template '{$templateName}' not found");
        }
        $allParams = array_merge($this->params, $params);
        extract($allParams);
        ob_start();
        include $this->pathToPage . $templateName;
        $pageContent = ob_get_clean();
        $layoutFile = $this->pathToPage . $this->layout;
        extract($allParams);
        ob_start();
        include $layoutFile;
        return ob_get_clean();
    }

}
