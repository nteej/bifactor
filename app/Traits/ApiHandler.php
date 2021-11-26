<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

/**
 *
 */
trait ApiHandler
{
    /**
     *
     * @param $message
     * @param mixed $data
     * @param int $status
     * @return JsonResponse
     */
    protected function success($message, $data = [], int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    /**
     * @param $message
     * @param int $status
     * @return JsonResponse
     */
    protected function failure($message, int $status = 422): JsonResponse
    {
        return response()->json([
            'success' => false,
            'data' => [],
            'message' => $message,
        ], $status);
    }
}
