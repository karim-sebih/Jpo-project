<?php
namespace App\Models;

use App\Core\Databa;
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
    // Delete
    protected function delete(int $id): bool {
        return $this->sqlQuery("DELETE FROM $this->tableName WHERE id = :id;", ['id' => $id]);
    }
    
    private function buildClauses(array $filters): string {
        if (empty($filters)) {
            return '';
        }
        $clauses = [];
        foreach ($filters as $key => $value) {
            $clauses[] = "$key = :$key";
        }
        return 'WHERE ' . implode(' AND ', $clauses);
    }
    protected function sqlQuery(string $query, array $params = []): bool {
        try {
            $stmt = $this->db->prepare($query);
            return $stmt->execute($params);
        } catch (\Exception $err) {
            throw new \Exception("Une erreur est survenue lors de l'exécution de la requête suivante :\n- $query\nErreur : {$err->getMessage()}");
        }
    }
}

    