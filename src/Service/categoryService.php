<?php

namespace src\Service;
use src\Repository\CategoryRepository;

require_once __DIR__ . "/../Repository/CategoryRepository.php";
class categoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct(){
        $this->categoryRepository = new CategoryRepository();
    }

    public function getAllCategories(){
        return $this->categoryRepository->getCategories();
    }
}