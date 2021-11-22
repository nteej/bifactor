<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

/**
 *
 */
class APIController extends Controller
{
    /**
     * @param array $data
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function respondOk($data = [], int $statusCode = 200): JsonResponse
    {
        return $this->respond($data, $statusCode);
    }

    /**
     * @param array $data
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function respondNotOk(array $data = [], int $statusCode = 400): JsonResponse
    {
        return $this->respond($data, $statusCode);
    }

    /**
     * @param $data
     * @param int $statusCode
     * @return JsonResponse
     */
    private function respond($data, int $statusCode): JsonResponse
    {
        return new JsonResponse($data, $statusCode);
    }

}
