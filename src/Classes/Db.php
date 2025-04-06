<?php

namespace App\Classes;
use App\Classes\DbInterface;

/**
 * Database connection class and basic CRUD operations
 */
class Db implements DbInterface
{
    /**
     * The db instance to use
     */
    private DbTypeInterface $db;

    public function __construct(DbTypeInterface $db_obj)
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
     /**
     * Get adapter for the database types' get method
     */
    public function add(string $table, array $data): string
    {
        $result = $this->db->add($table, $data);
        return $result;
    }
     /**
     * Get adapter for the database types' get method
     */
    public function update(string $table, array $data, string $where): string
    {
        $result = $this->db->update($table, $data, $where);
        return $result;
    }
     /**
     * Get adapter for the database types' get method
     */
    public function delete(string $table, string $where): string
    {
        $result = $this->db->delete($table, $where);
        return $result;
    }

    public function find(string $table, array $where): array
    {
        $result = $this->db->find($table, $where);
        return $result;

    }
}