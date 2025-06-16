<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class Comment extends Model {
    protected $table = 'comment';

    public function create($userId, $eventId, $message) {
        $sql = "INSERT INTO {$this->table} (id_user, id_event, time, message) VALUES (:user_id, :event_id, NOW(), :message)";
        $params = [
            ':user_id' => $userId,
            ':event_id' => $eventId,
            ':message' => $message
        ];
        
        $this->executeQuery($sql, $params);
        return $this->pdo->lastInsertId();
    }

    public function getForEvent($eventId) {
        $sql = "SELECT c.*, u.Nom, u.Prenom 
                FROM {$this->table} c
                JOIN user u ON c.id_user = u.id
                WHERE c.id_event = :event_id
                ORDER BY c.time DESC";
        $stmt = $this->executeQuery($sql, [':event_id' => $eventId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($commentId) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $this->executeQuery($sql, [':id' => $commentId]);
    }

    public function getTotalComments() {
        $sql = "SELECT COUNT(*) as total FROM {$this->table}";
        $stmt = $this->executeQuery($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}