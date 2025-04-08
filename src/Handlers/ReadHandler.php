<?php

namespace App\Handlers;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Classes\ClassFactory;
use App\Configs\Messages;
use App\Configs\Configs;

header("Content-Type: application/json;");

// Database instance
$db = ClassFactory::getClass('db');

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {

    try {

        // Decode the data coming as json here
        $data = json_decode((file_get_contents('php://input')), true);

        // Delete this user
        $db->get('users', Configs::getConfig('read_limit'));

        echo json_encode([
            'status' => Messages::getMessage('success'),
            'message' => Messages::getCode("success")
        ]);

    } catch (\Exception $e) {

        // Fallback catch for any encoding error
        echo json_encode([
            'status' => Messages::getMessage('bad_format'),
            'code' => Messages::getCode('bad_format')
        ]);
        exit;
    }
} else {

    echo json_encode([
        'status' => Messages::getMessage('not_supported'),
        'code' => Messages::getCode('not_supported')
    ]);
    exit;
}