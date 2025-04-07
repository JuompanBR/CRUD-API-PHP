<?php

require_once __DIR__.'/vendor/autoload.php';

header('Content-Type: application/json');

$testData = [
    'user' => 'working',
    'user' => 'another',
];

// domain/resource/parameters?query=string
$base_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Decode the data coming as json here
$data = json_decode((file_get_contents('php://input')), true);

// Route the request to the appropriate handler
// get request method from the request
$method = $_SERVER['REQUEST_METHOD'];
$resources = [
    'users' => [
        'controller' => 'UserHandler',
        'methods' => [
            'GET' => [
                '' => 'listUsers',
                '/\d+/' => 'getUser',
            ],
            'POST' => 'createuser',
            'PUT' => 'updateuser',
            'DELETE' => 'deleteuser',
        ],
    ],
];
// UserHandler class from handlers folder
// get request uri

$request_uri = explode('/', $base_url);
$resourceKey = $request_uri[1];
$objectKey = $request_uri[2];

// check if key in array exists
if (array_key_exists($resourceKey, $resources)) {

    // check if method is in supported methods for resource
    if (array_key_exists($method, $resources[$resourceKey]['methods'])) {
        $controller = $resources[$resourceKey]['controller'];
        $method = $resources[$resourceKey]['methods'][$method];
        if (is_array($method) && $method->count() > 0) {
            $matchingMethod = array_find($method, function ($record) {
                preg_match($record, $objectKey);
            });
        }

        $handler = "App\\Handlers\\{$controller}";
        $controller = new $handler;

        return $controller->$method($data);
    }

    echo json_encode([
        'status' => 405,
        'message' => 'Method not allowed',
    ]);
}

// set header to 404
header('HTTP/1.1 404 Not Found');
// add json body to header
header('Content-Type: application/json');

echo json_encode([
    'status' => 404,
    'message' => 'Not found',
]);
