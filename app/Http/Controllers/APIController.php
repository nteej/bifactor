<?php

namespace App\Http\Controllers;

use App\Services\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

/**
 *API response manipulation binder
 */
class APIController extends Controller
{
    use ApiResponseTrait;


    /**
     * @param mixed $data
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
     * @param array $headers
     * @return array
     */
    public function parseGivenData($data = [], $statusCode = 200, $headers = [])
    {
        $responseStructure = [
            'success' => $data['success'],
            'message' => $data['message'] ?? null,
            'result' => $data['result'] ?? null,
        ];
        if (isset($data['errors'])) {
            $responseStructure['errors'] = $data['errors'];
        }
        if (isset($data['status'])) {
            $statusCode = $data['status'];
        }


        if (isset($data['exception']) && ($data['exception'] instanceof Error || $data['exception'] instanceof Exception)) {
            if (config('app.env') !== 'production') {
                $responseStructure['exception'] = [
                    'message' => $data['exception']->getMessage(),
                    'file' => $data['exception']->getFile(),
                    'line' => $data['exception']->getLine(),
                    'code' => $data['exception']->getCode(),
                    'trace' => $data['exception']->getTrace(),
                ];
            }

            if ($statusCode === 200) {
                $statusCode = 500;
            }
        }
        if ($data['success'] === false) {
            if (isset($data['error_code'])) {
                $responseStructure['error_code'] = $data['error_code'];
            } else {
                $responseStructure['error_code'] = 1;
            }
        }
        return ["content" => $responseStructure, "statusCode" => $statusCode, "headers" => $headers];
    }


    /*
     *
     * Just a wrapper to facilitate abstract
     */

    /**
     * Return generic json response with the given data.
     *
     * @param       $data
     * @param int $statusCode
     * @param array $headers
     *
     * @return JsonResponse
     */
    protected function apiResponse($data = [], $statusCode = 200, $headers = [])
    {
        // https://laracasts.com/discuss/channels/laravel/pagination-data-missing-from-api-resource

        $result = $this->parseGivenData($data, $statusCode, $headers);


        return response()->json(
            $result['content'], $result['statusCode'], $result['headers']
        );
    }


    /**
     * @param mixed $data
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function respondApi($data = [], int $statusCode = 200, $message = null, $headers = []): JsonResponse
    {
        return $this->apiResponse(
            [
                'success' => true,
                'result' => $data,
                'message' => $message
            ], $statusCode, $headers
        );
    }

    /**
     * @param mixed $data
     * @param int $statusCode
     * @return JsonResponse
     */
    private function respond($data, int $statusCode): JsonResponse
    {
        return new JsonResponse($data, $statusCode);
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

}
