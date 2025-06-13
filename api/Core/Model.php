<?php
namespace App\Core;

use PDO;
use PDOException;

class Model {
    protected $pdo;
    protected $table;

    public function __construct() {
        $this->connect();
    }

    protected function connect() {
        if (!$this->pdo) {
            try {
                $config = require __DIR__ . '/../../config/database.php';
                $this->pdo = new PDO(
                    "mysql:host={$config['db']['host']};dbname={$config['db']['dbname']};charset={$config['db']['charset']}",
                    $config['db']['username'],
                    $config['db']['password']
                );
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log("Database connection failed: " . $e->getMessage());
                throw new \RuntimeException("Database connection failed");
            }
        }
    }

    protected function executeQuery($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            error_log("Query failed: " . $e->getMessage() . " [SQL: $sql]");
            throw new \RuntimeException("Database query failed");
        }
    }
}