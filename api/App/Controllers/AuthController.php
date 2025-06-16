<?php
namespace App\Controllers;

use App\Models\User;
use App\Core\Controller;

class AuthController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function register() {
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (empty($data['email']) || empty($data['password']) || 
               empty($data['nom']) || empty($data['prenom'])) {
                throw new \InvalidArgumentException("All fields are required");
            }

            if ($this->userModel->findByEmail($data['email'])) {
                throw new \InvalidArgumentException("Email already exists");
            }

            $userId = $this->userModel->create($data);
            
            return $this->jsonResponse([
                'success' => true,
                'message' => 'Registration successful',
                'user_id' => $userId
            ], 201);

        } catch (\InvalidArgumentException $e) {
            return $this->jsonResponse(['error' => $e->getMessage()], 400);
        } catch (\RuntimeException $e) {
            error_log("Registration error: " . $e->getMessage());
            return $this->jsonResponse(
                ['error' => 'Registration service unavailable. Please try later.'], 
                500
            );
        }
    }

    public function login() {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (empty($data['email']) || empty($data['password'])) {
                throw new \InvalidArgumentException("Email and password are required");
            }
            
            $user = $this->userModel->verifyCredentials($data['email'], $data['password']);
            
            if (!$user) {
                throw new \InvalidArgumentException("Invalid credentials", 401);
            }
            
            // Start session or generate JWT token here
            $_SESSION['user'] = [
                'id' => $user['id'],
                'email' => $user['email'],
                'role' => $user['role']
            ];
            
            return $this->jsonResponse([
                'success' => true,
                'user' => [
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'nom' => $user['Nom'],
                    'prenom' => $user['Prenom'],
                    'role' => $user['role']
                ]
            ]);

        } catch (\InvalidArgumentException $e) {
            $code = $e->getCode() ?: 400;
            return $this->jsonResponse(['error' => $e->getMessage()], $code);
        } catch (\Exception $e) {
            error_log("Login error: " . $e->getMessage());
            return $this->jsonResponse(
                ['error' => 'Login service unavailable'], 
                500
            );
        }
    }
}