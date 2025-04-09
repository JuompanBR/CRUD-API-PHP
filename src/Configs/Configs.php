<?php
namespace App\Configs;

/**
 * This class holds general configurations for the app
 */
class Configs
{

    public static function getConfig(string $filter='*'): array|string
    {

        $configs = [
            'dbhost'     => getenv('DB_HOST') ?: 'mysql',
            'dbname'     => getenv('DB_DATABASE') ?: 'assignment_1',
            'dbusername' => getenv('DB_USERNAME') ?: 'crud_user',
            'dbpassword' => getenv('DB_PASSWORD') ?: 'crud_pass',
            'read_limit' => 50
        ];

        if ($filter == "*") {

            return $configs;
        }
        
        return $configs[$filter] ?? 'Unknown config key';
    }
}