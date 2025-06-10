<?php 
namespace Core;
use Exception;
use JsonSerializable;

class ApiResponse implements JsonSerializable {
    private int $sta