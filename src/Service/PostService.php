<?php

namespace src\Service;
require_once __DIR__ . "/../Repository/PostRepository.php";
require_once __DIR__ . "/../Handler/formValidator.php";
use \src\Repository\PostRepository;
use Handlers\FormValidator;
class PostService
{
    private $repository;
    private $formValidator;
    public function __construct(){
        $this->repository = new PostRepository();
        $this->formValidator = new FormValidator();
    }

    public function getPosts(){
        return $this->repository->getPosts();
    }

    public function getPost($id){
        return $this->repository->getPost($id);
    }

    public function addPost(array $data): array {
        $post_title = formValidator::sanitizeData(trim($data['post_title'] ?? ''));
        $post_description = formValidator::sanitizeData(trim($data['post_description'] ?? ''));
        $post_gif = formValidator::sanitizeData(trim($data['post_gif'] ?? ''));
        $cat_id = isset($data['cat_id']) && $data['cat_id'] !== '' ? (int)$data['cat_id'] : null;
        if (!formValidator::requiredField($post_title) || !formValidator::requiredField($post_description)) {
            return ['error' => 'Title and description are required'];
        }
        if (!formValidator::validateForm(5, 25, $post_title)) {
            return ['error' => 'Post title mus tbe between 5 and 25 characters'];
        }

        if (!formValidator::validateForm(10, 500, $post_description)) {
            return ['error' => 'Описание поста должно быть от 10 до 500 символов.'];
        }
        try {
            $this->repository->createPost($post_title, $post_description, $cat_id, $post_gif);
            return ['success' => 'Пост успешно создан!'];
        } catch (\PDOException $e) {
            return ['error' => 'Ошибка при сохранении поста: ' . $e->getMessage()];
        }
    }
}