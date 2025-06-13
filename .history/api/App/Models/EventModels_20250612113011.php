<?php
namespace App\Models;

use Core\Database;
use Pdo ;

class EventModels
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getEventById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM events WHERE id = :id");
        $stmt->bindParam(':id', $id, Pdo::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(Pdo::FETCH_ASSOC);
    } 

    public function getAllEvents($filters = [])
    {
        $query = "SELECT * FROM events";
        if (!empty($filters)) {
            $query .= " WHERE " . implode(' AND ', array_map(function ($key) {
                return "$key = :$key";
            }, array_keys($filters)));
        }
        $stmt = $this->db->prepare($query);
        foreach ($filters as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();
        return $stmt->fetchAll(Pdo::FETCH_ASSOC);
    }

    public function createEvent($data)
    {
        $stmt = $this->db->prepare("INSERT INTO events (name, date, location_id) VALUES (:name, :date, :location_id)");
        return $stmt->execute($data);
    }

    public function updateEvent($id, $data)
    {
        $data['id'] = $id;
        $stmt = $this->db->prepare("UPDATE events SET name = :name, date = :date, location_id = :location_id WHERE id = :id");
        return $stmt->execute($data);
    }

    public function deleteEvent($id)
    {
        $stmt = $this->db->prepare("DELETE FROM events WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
    
}