<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Interface\OrderServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group User Order management
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

    /**
     * Submit the order
     * @authenticated
     * @urlParam id int required The ID of the order. Example: 1
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function submit(Request $request, int $id): JsonResponse
    {
        $serviceResponse = $this->orderService->submit($request, $id);
        return $this->convertToJsonResponse($serviceResponse);
    }

    /**
     * Add product to cart
     * @authenticated
     * @bodyParam product_id int required The ID of the product. Example: 1
     * @bodyParam quantity int required The quantity of the product. Example: 1
     * @param Request $request
     * @return JsonResponse
     */
    public function addToCart(Request $request): JsonResponse
    {
        $serviceResponse = $this->orderService->addToCart($request);
        return $this->convertToJsonResponse($serviceResponse);
    }
}
