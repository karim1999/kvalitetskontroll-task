<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Interface\OrderServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Admin Order management
 *
 * APIs for managing user's orders
 */
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
     * List orders
     * @authenticated
     * @queryParam page int The page number. Example: 1
     * @queryParam per_page int The number of items per page. Example: 10
     * @queryParam user_id int The user id of products. Example: 10
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $serviceResponse = $this->orderService->list($request);
        return $this->convertToJsonResponse($serviceResponse);
    }

    /**
     * Show order
     * @authenticated
     * @urlParam id int required The ID of the order. Example: 1
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
