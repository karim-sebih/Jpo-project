<?php
namespace App\Models;

use App\Core\Model;
use PDO;
use PDOException;

class User extends Model {
    protected $table = 'user';

    public function create($data) {
        // ================= INPUT VALIDATION =================
        if (empty($data['nom']) || empty($data['prenom'])) {
            throw new \InvalidArgumentException("First and last name are required");
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Invalid email format");
        }

        if (strlen($data['password']) < 8) {
            throw new \InvalidArgumentException("Password must be at least 8 characters");
        }

        // ================= DATABASE OPERATION =================
        try {
            $sql = "INSERT INTO {$this->table} (Nom, Prenom, email, password, role) 
                    VALUES (:nom, :prenom, :email, :password, :role)";
            
            $params = [
                ':nom' => htmlspecialchars($data['nom']), // XSS protection
                ':prenom' => htmlspecialchars($data['prenom']),
                ':email' => $data['email'],
                ':password' => password_hash($data['password'], PASSWORD_BCRYPT),
                ':role' => $data['role'] ?? 0
            ];
            
            $this->executeQuery($sql, $params);
            return $this->pdo->lastInsertId();

        } catch (PDOException $e) {
            // ================= ERROR LOGGING =================
            error_log("[".date('Y-m-d H:i:s')."] User creation failed: " . $e->getMessage());
            throw new \RuntimeException("Database error during registration");
        }
    }

    public function findByEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Invalid email format");
        }

        try {
            $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE email = ?");
            $stmt->execute([$email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log("[".date('Y-m-d H:i:s')."] Database query failed: " . $e->getMessage());
            throw new \RuntimeException("Database error");
        }
    }


public function verifyCredentials($email, $password) {
    try {
        $user = $this->findByEmail($email);
        if (!$user) {
            return false;
        }
        
        if (password_verify($password, $user['password'])) {
            return $user;
        }
        
        return false;
    } catch (PDOException $e) {
        error_log("[".date('Y-m-d H:i:s')."] Login verification failed: " . $e->getMessage());
        throw new \RuntimeException("Database error during login");
    }
}
}
