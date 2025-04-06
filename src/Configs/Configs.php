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
            'dbhost' => 'localhost',
            'dbusername' => 'your_database_name',
            'dbpassword' => 'your_database_password',
        ];

        if ($filter == "*") {

            return $configs;
        }
        
        return $configs[$filter] ?? 'Unknown config key';
    }
}