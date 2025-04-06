<?php

namespace App\Handlers;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Classes\ClassFactory;
use App\Configs\Messages;

// Pattern: Factory Class
// $db = ClassFactory::getClass('db');

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

        // If using a database, uncomment this part and integrate it with your class
        // $db->add('users', [
        //     'username' => $username,
        //     'password' => $hashedPassword,
        //     'email' => $email
        // ]);

        echo json_encode([
            'status' => 'success',
            'message' => "User created successfully: $username"
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
