<?php
namespace App\Classes;

/**
 * The interface for the different db types for e.g., MySQL, MongoDB, etc...
 */
interface DbTypeInterface
{
    public function get(string $table, int $limit): array;
    public function add(string $table, array $data): string;
    public function getInstance();
}