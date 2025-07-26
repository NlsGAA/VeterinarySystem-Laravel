<?php

namespace App\Http\Controllers;

use App\DTO\Responses\ApiResponseDTO;

abstract class Controller
{
    public function sendResponse(
        string $message,
        ?array $data,
        int $code = 200,
        ?array $metadata = null
    )
    {
        $apiResponse = new ApiResponseDTO(
            success: true,
            message: $message,
            data: $data,
            metadata: $metadata
        );

        return response()->json($apiResponse->toArray(), $code);
    }

    public function sendError(string $message, int $code = 500)
    {
        $apiResponse = new ApiResponseDTO(
            success: false,
            message: $message,
            data: null,
        );

        return response()->json($apiResponse->toArray(), $code);
    }
}
