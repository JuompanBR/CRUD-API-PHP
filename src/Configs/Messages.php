<?php
namespace App\Configs;

class Messages
{

    public static function getMessage(string $type): string
    {
        $messages = [
            'success' => 'Operation was successful',
            'error' => 'An error occurred',
            'not_found' => 'Item not found',
            'invalid_input' => 'Invalid input provided',
            'unauthorized' => 'Unauthorized access',
        ];

        return $messages[$type] ?? 'Unknown message key';
    }
}