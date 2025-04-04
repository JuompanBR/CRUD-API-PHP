<?php
namespace App\Classes;

class Router {
    private $routes = [];

    public function get($path, $callback) {
        $this->routes['GET'][$path] = $callback;
    }

    public function post($path, $callback) {
        $this->routes['POST'][$path] = $callback;
    }

    public function resolve($method, $path) {
        $callback = $this->routes[$method][$path] ?? null;

        if (!$callback) {
            http_response_code(404);
            echo "404 - Not Found";
            return;
        }

        if (is_callable($callback)) {
            call_user_func($callback);
        } elseif (is_array($callback)) {
            $controller = new $callback[0]();
            $method = $callback[1];
            call_user_func([$controller, $method]);
        }
    }
}