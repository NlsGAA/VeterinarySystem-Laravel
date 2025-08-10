<?php

namespace App\Http\Controllers;

use App\DTO\Responses\ApiResponseDTO;

/**
 *  @OA\Info(
 *     version="1.0.0",
 *     title="VetSystem API"
 *  ),
 *  @OA\Server(
 *      url="http://localhost:8000/api",
 *      description="API server"
 *  )
 *
 */
abstract class Controller
{
    public function sendResponse(
        string $message,
        ?array $data = null,
        int $code = 200,
        ?array $metadata = null
    ) {
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
