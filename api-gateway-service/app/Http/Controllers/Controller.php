<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Client\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @param Response $serviceResponse
     * @return JsonResponse
     */
    public function convertToJsonResponse(Response $serviceResponse): JsonResponse
    {
        return response()
            ->json($serviceResponse->json(), $serviceResponse->status(), $serviceResponse->headers());
    }
}
