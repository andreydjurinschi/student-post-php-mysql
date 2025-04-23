<?php

namespace src\Controller;
use src\Service\categoryService;

require_once __DIR__.'/../Service/CategoryService.php';
class CategoryController
{
    private $categoryService;
    public function __construct(){
        $this->categoryService = new CategoryService();
    }
    public function getCategories(){
        return $this->categoryService->getAllCategories();
    }
    public function getCategory($id){
        return $this->categoryService->getCategory($id);
    }
}