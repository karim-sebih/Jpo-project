<?php
namespace Core;
use PDO;
use PDPOStatment;
use Exception;

abstract class Database{
    private ?PDO $pdo = null;

    protected ?PDOStatement $stmt = null;

    private string $tableName;

    public function __construct(string $tableName) {
        $this->tableName = $tableName;
        $this->connect();
    }

    protected function connect(): void {
        if ($this->pdo === null) {
            $dsn = 'mysql:host=localhost;dbname=your_database_name;charset=utf8';
            $username = 'your_username';
            $password = 'your_password';

            try {
                $this->pdo = new PDO($dsn, $username, $password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $e) {
                throw new Exception('Database connection failed: ' . $e->getMessage());
            }
        }
    }
}
