<?php
namespace App\Controllers;

use App\Models\Event;
use App\Models\Comment;
use App\Core\Controller;

class AdminController extends Controller {
    private $eventModel;
    private $commentModel;

    public function __construct() {
        $this->eventModel = new Event();
        $this->commentModel = new Comment();
    }

    public function getEvents() {
        $events = $this->eventModel->getAll();
        return $this->jsonResponse($events);
    }

    public function deleteComment($id) {
        $this->commentModel->delete($id);
        return $this->jsonResponse(['message' => 'Comment deleted successfully']);
    }

    public function getStats() {
        $stats = [
            'total_events' => count($this->eventModel->getAll()),
            'total_users' => $this->eventModel->getTotalUsers(),
            'total_comments' => $this->commentModel->getTotalComments(),
        ];
        
        return $this->jsonResponse($stats);
    }
}