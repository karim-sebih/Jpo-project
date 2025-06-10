<?php 
namespace Core;
use Exception;
use JsonSerializable;

class ApiResponse implements JsonSerializable {
    private int $status;
    private string $message;
    private array $data;

    public function __construct(int $status, string $message, array $data = []) {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
    }

    public function jsonSerialize(): array {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data
        ];
    }
}
