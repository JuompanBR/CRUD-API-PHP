<?php
namespace App\Configs;

class Messages
{

    public static function getMessage(string $type): string
    {
        $messages = [
            'success' => 'Operation was successful',
            'success_created' => 'Item was successfully created',
            'error' => 'An error occurred',
            'not_found' => 'Item not found',
            'invalid_input' => 'Invalid input provided',
            'unauthorized' => 'Unauthorized access',
            'bad_format' => 'Bad format',
        ];

        return $messages[$type] ?? 'Unknown message key';
    }

    public static function getCode(string $type): int
    {
        $codes = [
            'success' => 200,
            'success_created' => 201,
            'error' => 500,
            'not_found' => 404,
            'invalid_input' => 400,
            'unauthorized' => 401,
            'bad_format' => 400,
        ];

        return $codes[$type] ?? 500;
    }
}