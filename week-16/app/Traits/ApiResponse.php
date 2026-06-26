<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    protected function success($data = null, string $message = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error(string $message = null, int $code = 400, $errors = null): JsonResponse
    {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'errors' => $errors
        ], $code);
    }
}
