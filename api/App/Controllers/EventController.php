<?php
namespace App\Controllers;

use App\Models\Event;
use App\Models\Location;
use App\Models\Participation;
use App\Models\Comment;
use App\Core\Controller;

class EventController extends Controller {
    private $eventModel;
    private $locationModel;
    private $participationModel;
    private $commentModel;

    public function __construct() {
        $this->eventModel = new Event();
        $this->locationModel = new Location();
        $this->participationModel = new Participation();
        $this->commentModel = new Comment();
    }

    public function getAll() {
        $events = $this->eventModel->getAll();
        return $this->jsonResponse($events);
    }

    public function get($id) {
        $event = $this->eventModel->getById($id);
        if (!$event) {
            return $this->jsonResponse(['error' => 'Event not found'], 404);
        }
        
        $comments = $this->commentModel->getForEvent($id);
        $event['comments'] = $comments;
        
        return $this->jsonResponse($event);
    }

    public function create() {
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (empty($data['time']) || empty($data['id_lieux']) || empty($data['capacite'])) {
            return $this->jsonResponse(['error' => 'All fields are required'], 400);
        }
        
        $eventId = $this->eventModel->create($data);
        return $this->jsonResponse([
            'message' => 'Event created successfully',
            'event_id' => $eventId
        ], 201);
    }

    public function update($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        
        $updated = $this->eventModel->update($id, $data);
        if (!$updated) {
            return $this->jsonResponse(['error' => 'Event not found'], 404);
        }
        
        return $this->jsonResponse(['message' => 'Event updated successfully']);
    }

    public function delete($id) {
        $this->eventModel->delete($id);
        return $this->jsonResponse(['message' => 'Event deleted successfully']);
    }

    public function register($eventId) {
        $data = json_decode(file_get_contents('php://input'), true);
        $userId = $data['user_id'] ?? null;
        
        if (!$userId) {
            return $this->jsonResponse(['error' => 'User ID required'], 400);
        }
        
        $this->participationModel->register($userId, $eventId);
        return $this->jsonResponse(['message' => 'Registered for event successfully']);
    }

    public function unregister($eventId) {
        $data = json_decode(file_get_contents('php://input'), true);
        $userId = $data['user_id'] ?? null;
        
        if (!$userId) {
            return $this->jsonResponse(['error' => 'User ID required'], 400);
        }
        
        $this->participationModel->unregister($userId, $eventId);
        return $this->jsonResponse(['message' => 'Unregistered from event successfully']);
    }

    public function addComment($eventId) {
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (empty($data['user_id']) || empty($data['message'])) {
            return $this->jsonResponse(['error' => 'User ID and message are required'], 400);
        }
        
        $commentId = $this->commentModel->create($data['user_id'], $eventId, $data['message']);
        return $this->jsonResponse([
            'message' => 'Comment added successfully',
            'comment_id' => $commentId
        ], 201);
    }
}