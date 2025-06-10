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

    protected function sqlQuery(string $query, array $params = []): bool {
        $this->getConnection();
        try {
            $this->stmt = $this->pdo->prepare($query);
            return $this->stmt->execute($params);
        } catch (Exception $err) {
            throw new Exception("SQL query failed: " . $err->getMessage());
        }
    }

    protected function create(array $data): bool {
        $fields = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), '?'));
        return $this->sqlQuery("INSERT INTO {$this->tableName} ({$fields}) VALUES ({$placeholders})", array_values($data));
    }

    protected function readOne(int $id): ?array {
        $this->sqlQuery("SELECT * FROM {$this->tableName} WHERE id = ?", [$id]);
        return $this->stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    protected function readAll(): array {
        $this->sqlQuery("SELECT * FROM {$this->tableName}");
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function update(int $id, array $data): bool {
        $set = implode(", ", array_map(fn($field) => "{$field} = ?", array_keys($data)));
        return $this->sqlQuery("UPDATE {$this->tableName} SET {$set} WHERE id = ?", array_merge(array_values($data), [$id]));
    }







}
