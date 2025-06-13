<?php
namespace App\Models;

use App\Core\Model;

class Location extends Model {
    protected $table = 'lieux';

    public function getAll() {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->executeQuery($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO {$this->table} (adresse, cp, ville) VALUES (:adresse, :cp, :ville)";
        $params = [
            ':adresse' => $data['adresse'],
            ':cp' => $data['cp'],
            ':ville' => $data['ville']
        ];
        
        $this->executeQuery($sql, $params);
        return $this->pdo->lastInsertId();
    }
}