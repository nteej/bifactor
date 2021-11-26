<?php

namespace App\Http\Controllers;

use App\Traits\ApiHandler;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Billie Bi Factor API",
     *      description="Billie Backend Challenge API Documentation",
     *      @OA\Contact(
     *          email="nteeje@gmail.com"
     *      )
     * )
     *
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Billie Bi Factor API Server"
     * )
     *
     * @OA\Tag(
     *     name="BiFactor",
     *     description="API Endpoints of Billie Bi Factor"
     * )
     */

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ApiResponseTrait,ApiHandler;
}
