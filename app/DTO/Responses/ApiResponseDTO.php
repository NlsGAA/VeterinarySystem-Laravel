<?php

namespace App\DTO\Responses;

class ApiResponseDTO
{
    public string $success;
    public string $message;
    public ?array $data;
    public ?array $metadata;

    public function __construct(
        string $success,
        string $message,
        ?array $data = null,
        ?array $metadata = null,
    ) {
        $this->success  = $success;
        $this->message  = $message;
        $this->data     = $data;
        $this->metadata = $metadata;
    }

    public function toArray(): array
    {
        $apiResponse = [
            'success' => $this->success,
            'message' => $this->message,
            'data'    => $this->data
        ];

        if (!empty($this->metadata)) {
            $apiResponse['metadata'] = $this->metadata;
        }

        return $apiResponse;
    }
}