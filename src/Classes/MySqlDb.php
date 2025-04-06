<?php

namespace App\Classes;

use App\Classes\DbTypeInterface;
use App\Configs\Messages;
use App\Configs\Configs;

use PDO;
use PDOException;

/**
 * Database connection class and basic CRUD operations
 */
class MySqlDb implements DbTypeInterface
{
    /**
     * @var MySqlDb|null The db instance to share to the use
     */
    public static ?MySqlDb $instance = null;
    /**
     * @var PDO|null The PDO connection to the database
     */
    private ?PDO $connection = null;
    /**
     * @var string|null The data source name for the database connection
     */
    private ?string $dsn = null;

    /**
     * Constuctor for the Db class
     * @param string $dsn Data source name for te databse connection
     */
    private function __construct(Configs $configs)
    {

        $dsn_local = 'mysql:host=' . $configs->getConfig('dbhost') . ';dbname=' . $configs->getConfig('dbname') . ';charset=utf8mb4';

        try {

            $this->connection = new PDO($dsn_local, $configs->getConfig('dbusername'), $configs->getConfig('dbpassword'));
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dsn = $dsn_local;
        } catch (PDOException $e) {

            echo "Connection failed: " . $e->getMessage();
        }
    }

    /**
     * Get te instance of the Db class
     * @return DbTypeInterface instance
     */
    public static function getInstance(): DbTypeInterface
    {
        if (is_null(self::$instance)) {

            // Pattern: Dependency injection
            self::$instance = new MySqlDb(new Configs());
        }
        return self::$instance;
    }

    /**
     * Get an element from the database
     * 
     * @param string $table The table to get the element
     * @param int $limit The limit for the get query
     * 
     * @return array The result of the get query
     */
    public function get(string $table, int $limit): array
    {
        $result = [];

        // Format the sql query
        $query = "SELECT * FROM $table LIMIT $limit;";

        // Prepare and execute the sql query
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        // Fetch the result
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Add an element to the database
     * 
     * @param string $table The table to get the element
     * @param array $data The data to add to the database
     * 
     * @return string The state of the add query
     */
    public function add(string $table, array $data): string
    {
        // Prevent sql injection attacks by using prepared statements
        $query = "INSERT INTO $table (" . implode(", ", array_keys($data)) . ") VALUES (" . implode(", ", array_fill(0, count($data), '?')) . ")";

        // Prepare the statement
        $stmt = $this->connection->prepare($query);

        // Execute the query
        $stmt->execute(array_values($data));

        // Check if the query was successful
        if ($stmt->rowCount() > 0) {

            return Messages::getMessage('success');
        } else {

            return Messages::getMessage('error');
        }
    }

    /**
     * Update an element to the database
     * 
     * @param string $table The table to get the element
     * @param array $data The data to update to the database
     * @param string $where The update selection criteria
     * 
     * @return string The state of the update query
     */
    public function update(string $table, array $data, string $where): string
    {
        // Prevent sql injection attacks by using prepared statements
        $query = "UPDATE $table SET " . implode(", ", array_map(fn($key) => "$key = ?", array_keys($data))) . " WHERE $where";

        // Prepare the statement
        $stmt = $this->connection->prepare($query);

        // Execute the query
        $stmt->execute(array_values($data));

        // Check if the query was successful
        if ($stmt->rowCount() > 0) {

            return Messages::getMessage('success');
        } else {

            return Messages::getMessage('error');
        }
    }

    /**
     * Update an element to the database
     * 
     * @param string $table The table to get the element
     * @param string $where The delete selection criteria
     * 
     * @return string The state of the update query
     */
    public function delete(string $table, string $where): string
    {
        // Prevent sql injection attacks by using prepared statements
        $query = "DELETE FROM $table WHERE $where";

        // Prepare the statement
        $stmt = $this->connection->prepare($query);

        // Execute the query
        $stmt->execute();

        // Check if the query was successful
        if ($stmt->rowCount() > 0) {

            return Messages::getMessage('success');
        } else {

            return Messages::getMessage('error');
        }
    }
    /**
     * Find an element in the database
     * 
     * @param string $table The table to get the element
     * @param array $where The find selection criteria
     * 
     * @return array The resulting documents
     */
    public function find(string $table, array $where): array
    {
        // Prevent sql injection attacks by using prepared statements
        $query = "SELECT * FROM $table WHERE " . implode(" AND ", array_map(fn($key) => "$key = ?", array_keys($where))) . " LIMIT 1";

        // Prepare the statement
        $stmt = $this->connection->prepare($query);

        // inding the ellement here
        $stmt->execute(array_values($where));

        // Fetch only one row here
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}