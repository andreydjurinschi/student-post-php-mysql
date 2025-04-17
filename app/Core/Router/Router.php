<?php

namespace app\Core;

class Router{
    private $routes = [];

    public function addRoute($method, $path, $handler){
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function dispatch($path){
        $method = $_SERVER['REQUEST_METHOD'];
        foreach ($this->routes as $route){
            if($method === $route['method'] && $path === $route['path']){
return                call_user_func($route['handler']);
            }
        }
        return http_response_code(404);
    }
}