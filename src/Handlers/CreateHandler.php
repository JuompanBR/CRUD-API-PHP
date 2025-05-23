<?php

namespace App\Handlers;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Classes\ClassFactory;
use App\Configs\Messages;

header("Content-Type: application/json;");

// Pattern: Factory Class
$db = ClassFactory::getClass('db');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {

        // Decode the JSON entering here
        $data = json_decode(file_get_contents('php://input'), true);

        $username = $data['username'] ?? null;
        $password = $data['password'] ?? null;
        $email = $data['email'] ?? null;

        // username and password are required fields
        if (!$username || !$password) {

            // Return a JSON response if input is invalid
            echo json_encode([
                'status' => Messages::getMessage('invalid_input'),
                'code' => Messages::getCode('invalid_input')
            ]);
            exit;
        }

        // hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Add the user
        $db->add('users', [
            'username' => $username,
            'password' => $hashedPassword,
            'email' => $email
        ]);

        echo json_encode([
            'status' => Messages::getMessage('success'),
            'code' => Messages::getCode("success")
        ]);

        exit;

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
