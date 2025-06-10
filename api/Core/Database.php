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
        //$this->getConnection();
        
        try {
            $this->stmt = $this->pdo->prepare($query);
            return $this->stmt->execute($params);
        } catch (Exception $err) {
            throw new Exception("Une erreur est survenue lors de l'exécution de la requête suivante :\n- $query\nErreur : {$err->getMessage()}");
        }
    }
    
    // Create
    protected function create(array $data): bool {
        $fields = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_map(fn($k) => ":$k", array_keys($data)));
        return $this->sqlQuery("INSERT INTO $this->tableName ($fields) VALUES ($placeholders)", $data);
    }
    
    // Read
    protected function readOne(int $id): ?array {
        $this->sqlQuery("SELECT * FROM $this->tableName WHERE id = :id;", ['id' => $id]);
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    protected function readAll(array $filters): array {
        var_dump($this->pdo);
        $this->sqlQuery("SELECT * FROM $this->tableName " . $this->buildClauses($filters));
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Update
    protected function update(int $id, array $data): bool {
        $setters = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));
        return $this->sqlQuery("UPDATE $this->tableName SET $setters WHERE id = :id;", ['id' => $id, ...$data]);
    }
    
    // Delete
    protected function delete(int $id): bool {
        return $this->sqlQuery("DELETE FROM $this->tableName WHERE id = :id;", ['id' => $id]);
    }
    

}
