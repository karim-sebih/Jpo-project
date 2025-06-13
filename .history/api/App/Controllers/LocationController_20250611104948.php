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