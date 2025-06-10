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
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=your_database_name', 'username', 'password');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $err) {
            throw new Exception("Database connection failed: " . $err->getMessage());
        }
    }

    protected function sqlQuery(string $query, array $params = []): ?a {
        $this->stmt = $this->pdo->prepare($query);
        $this->stmt->execute($params);
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }











}
