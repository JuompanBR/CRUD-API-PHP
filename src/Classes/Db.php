<?php

namespace App\Classes;
use App\Classes\MySqlDb;
use App\Configs\Messages;

/**
 * Database connection class and basic CRUD operations
 */
class Db 
{
    /**
     * @var MySqlDb The db instance to use
     */
    private $db;

    public function __construct(MySqlDb $db_obj)
    {
        $this->db = $db_obj->getInstance();
    }

    // Adapter pattern
    /**
     * Get adapter for the database types' get method
     */
    public function get(string $table, int $limit): array
    {
        $result = $this->db->get($table, $limit);
        return $result;
    }
}