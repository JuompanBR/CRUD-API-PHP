<?php

declare(strict_types=1);

namespace App\Handlers;

class UserHandler
{
    public function listUsers()
    {
        echo json_encode([
            'username' => 'Fake name',
            'email' => 'fake@email.com',
            'password' => 'fakepassword',
        ]);
    }

    public function getUser(string $userId)
    {
        echo json_encode([
            'id' => $userId,
            'username' => 'Fake name',
            'email' => 'fake@email.com',
            'password' => 'fakepassword',
        ]);
    }
}
