<?php
namespace App\Classes;
use App\Classes\Db;
use App\Classes\MySqlDb;
use App\Configs\Configs;

use stdClass;

// Pattern: Factory

/**
 * This class is responsible to generate other classes while
 * hiding the instantiation logic
 */
class ClassFactory
{
    public static function getClass(string $type, ?array $options=null)
    {
        switch ($type):
            case 'db':
                // Pattern: DI, strategy,   
                return new Db(
                    MySqlDb::getInstance()
                );
            default:
                return new stdClass();
        endswitch;
    }
}