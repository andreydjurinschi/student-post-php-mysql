<?php

namespace template;
class Template
{
    private string $pathToPage;

    private array $pageParams;
    private string $layout = 'layout.php';

    public function __construct($pathToPage, $pageParams = []){
        $this->pathToPage = $pathToPage;
        $this->pageParams = $pageParams;
    }

    public function render($templateName, $params = []){
        if(!file_exists($this->pathToPage . $templateName)){
            throw new \Exception("Template '{$templateName}' not found");
        }
        extract($params);
        ob_start();
        include $this->pathToPage . $templateName;
        $pageContent = ob_get_clean();
        $layoutFile = $this->pathToPage . $this->layout;
        extract($params);
        ob_start();
        include $layoutFile;
        return ob_get_clean();
    }

    public function getPageParams($key){
        return $this->pageParams[$key];
    }

}
