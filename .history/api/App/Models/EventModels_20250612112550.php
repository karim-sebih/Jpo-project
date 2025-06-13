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
    <