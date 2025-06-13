<?php
namespace App\Controllers;

use App\Models\EventModels;

abstract class EventController
{
    protected $eventModel;

    public function __construct()
    {
        $this->eventModel = new EventModels();
    }

    public function getEvent($id)
    {
        return $this->eventModel->getEventById($id);
    }

    public function getAllEvents($filters = [])
    {
        return $this->eventModel->getAllEvents($filters);
    }

    public function createEvent($data)
    {
        return $this->eventModel->createEvent($data);
    }

    public function updateEvent($id, $data)
    {
        return $this->eventModel->updateEvent($id, $data);
    }

    public function deleteEvent($id)
    {
        return $this->eventModel->deleteEvent($id);
    }
}