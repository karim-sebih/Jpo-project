<?php
namespace App\Models;

use App\Core\Model;

class Participation extends Model {
    protected $table = 'participations';

    public function register($userId, $eventId) {
        $sql = "INSERT INTO {$this->table} (id_user, id_event) VALUES (:user_id, :event_id)";
        $params = [
            ':user_id' => $userId,
            ':event_id' => $eventId
        ];
        
        $this->executeQuery($sql, $params);
        return $this->pdo->lastInsertId();
    }

    public function unregister($userId, $eventId) {
        $sql = "DELETE FROM {$this->table} WHERE id_user = :user_id AND id_event = :event_id";
        $params = [
            ':user_id' => $userId,
            ':event_id' => $eventId
        ];
        
        $this->executeQuery($sql, $params);
    }

    public function getUserEvents($userId) {
        $sql = "SELECT e.*, l.adresse, l.cp, l.ville 
                FROM {$this->table} p
                JOIN event e ON p.id_event = e.id
                JOIN lieux l ON e.id_lieux = l.id
                WHERE p.id_user = :user_id";
        $stmt = $this->executeQuery($sql, [':user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}