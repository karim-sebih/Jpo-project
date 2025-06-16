<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class Event extends Model {
    protected $table = 'event';

    public function getAll() {
        $sql = "SELECT e.*, l.adresse, l.cp, l.ville 
                FROM {$this->table} e
                JOIN lieux l ON e.id_lieux = l.id";
        $stmt = $this->executeQuery($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT e.*, l.adresse, l.cp, l.ville 
                FROM {$this->table} e
                JOIN lieux l ON e.id_lieux = l.id
                WHERE e.id = :id";
        $stmt = $this->executeQuery($sql, [':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO {$this->table} (time, id_lieux, capacité) VALUES (:time, :id_lieux, :capacite)";
        $params = [
            ':time' => $data['time'],
            ':id_lieux' => $data['id_lieux'],
            ':capacite' => $data['capacite']
        ];
        
        $this->executeQuery($sql, $params);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data) {
        $sql = "UPDATE {$this->table} SET time = :time, id_lieux = :id_lieux, capacité = :capacite WHERE id = :id";
        $params = [
            ':id' => $id,
            ':time' => $data['time'],
            ':id_lieux' => $data['id_lieux'],
            ':capacite' => $data['capacite']
        ];
        
        $this->executeQuery($sql, $params);
        return $this->pdo->lastInsertId();
    }

    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $this->executeQuery($sql, [':id' => $id]);
    }

    public function getTotalUsers() {
        $sql = "SELECT COUNT(*) as total FROM user";
        $stmt = $this->executeQuery($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}