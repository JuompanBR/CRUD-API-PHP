<?php

namespace App\Handlers;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Classes\ClassFactory;
use App\Configs\Messages;

// Database instance
$db = ClassFactory::getClass('db');

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {

    try {

        // Decode the data coming as json here
        $data = json_decode((file_get_contents('php://input')), true);
        $id = $data['id'] ?? null;
        $payload = $data['data'] ?? null;

        if (!$id || !$payload) {

            echo json_encode([
                'status' => Messages::getMessage('bad_format'),
                'code' => Messages::getCode('bad_format')
            ]);
            exit;
        }

        // Delete this user
        $db->update('users', $payload, "id=$id");

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
}