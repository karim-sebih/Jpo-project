<?php
namespace App\Controllers;

use App\Models\LocationModels;

abstract class LocationController
{
    protected $locationModel;

    public function __construct()
    {
        $this->locationModel = new LocationModels();
    }

    public function getLocation($id)
    {
        return $this->locationModel->getLocationById($id);
    }

    public function getAllLocations($filters = [])
    {
        return $this->locationModel->getAllLocations($filters);
    }

    public function createLocation($data)
    {
        return $this->locationModel->createLocation($data);
    }

    public function updateLocation($id, $data)
    {
        return $this->locationModel->updateLocation($id, $data);
    }

    public function deleteLocation($id)
    {
        return $this->locationModel->deleteLocation($id);
    }
}
//
// This code defines an abstract class `LocationController` that provides methods to manage locations.             