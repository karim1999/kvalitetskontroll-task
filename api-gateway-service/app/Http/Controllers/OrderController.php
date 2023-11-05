<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Interface\OrderServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * @var OrderServiceInterface
     */
    private OrderServiceInterface $orderService;

    /**
     * @param OrderServiceInterface $orderService
     */
    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $serviceResponse = $this->orderService->list($request);
        return $this->convertToJsonResponse($serviceResponse);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function show(Request $request, int $id): JsonResponse
    {
        $serviceResponse = $this->orderService->find($request, $id);
        return $this->convertToJsonResponse($serviceResponse);
    }
}
