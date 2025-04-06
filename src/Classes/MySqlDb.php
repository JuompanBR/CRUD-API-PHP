<?php

namespace App\Classes;

use App\Classes\DbTypeInterface;
use App\Configs\Messages;
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
    private function __construct(string $dsn_user="mysql:host=localhost;dbname=your_database_name;charset=utf8mb4")
    {
        try {

            $this->connection = new PDO($dsn_user);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {

            echo "Connection failed: " . $e->getMessage();
        }
    }

    /**
     * Get te instance of the Db class
     * @return Db instance
     */
    public function getInstance(): MySqlDb
    {
        if (is_null($this->instance)) {

            $this->instance = new MySqlDb();
        }
        return $this->instance;
    }

    /**
     * Get an element from the database
     * 
     * @param string $table The table to get the element
     * @param int $limit The limit for the get query
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
}