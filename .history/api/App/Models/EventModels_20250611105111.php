<?php
namespace App\Models;

use App\Database\DatabaseConnection;
use PDO;
class LocationModels
{
    protected $db;

    public function __construct()
    {
        $this->db = DatabaseConnection::getInstance()->getConnection();
    }

    public function getLocationById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM locations WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllLocations($filters = [])
    {
        $query = "SELECT * FROM locations";
        if (!empty($filters)) {
            // Apply filters to the query
            // This is a simplified example; in a real application, you would need to handle this more robustly
            $query .= " WHERE " . implode(' AND ', array_map(function ($key) {
                return "$key = :$key";
            }, array_keys($filters)));
        }
        $stmt = $this->db->prepare($query);
        foreach ($filters as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createLocation($data)
    {
        $stmt = $this->db->prepare("INSERT INTO locations (name, address, latitude, longitude) VALUES (:name, :address, :latitude, :longitude)");
        return $stmt->execute($data);
    }

    public function updateLocation($id, $data)
    {
        $data['id'] = $id;
        $stmt = $this->db->prepare("UPDATE locations SET name = :name, address = :address, latitude = :latitude, longitude = :longitude WHERE id = :id");
        return $stmt->execute($data);
    }

    public function deleteLocation($id)
    {
        $stmt = $this->db->prepare("DELETE FROM locations WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}