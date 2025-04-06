<?php
namespace App\Classes;

/**
 * The interface for the different db types for e.g., MySQL, MongoDB, etc...
 */
interface DbInterface
{
    public function get(string $table, int $limit): array;
    public function add(string $table, array $data): string;
    public function update(string $table, array $data, string $where): string;
    public function delete(string $table, string $where): string;
    public function find(string $table, array $where): array;
}