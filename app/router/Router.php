<?php

namespace router;
class Router
{
    private array $routes = [];

    public function addRoute($method, $path, $controller){
        return $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller
        ];
    }

    public function dispatch($path){
        $method = $_SERVER['REQUEST_METHOD'];
        foreach ($this->routes as $route){
            if($path === $route['path'] && $method === $route['method']){
                return call_user_func($route['controller']);
            }
        }
        return http_response_code(404);
    }
}