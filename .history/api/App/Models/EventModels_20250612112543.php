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