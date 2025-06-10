<?php 
namespace Core;
use Exception;
use JsonSerializable;

class ApiResponse implements JsonSerializable {
    private int $status;
    private string $message;
    private array $data;

    pu