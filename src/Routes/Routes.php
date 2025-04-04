<?php
namespace App\Routes;
use App\Classes\Router;

$router = new Router();

$router->get('/home', function() {
    echo "Welcome to the homepage!";
});

$router->get('/users', [UserController::class, 'index']); // Points to UserController's index method

// Simulate a request
$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '/';

$router->resolve($method, $path);