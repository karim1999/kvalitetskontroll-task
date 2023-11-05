<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Interface\ProductServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group User Product management
 *
 * APIs for managing products
 */
class ProductController extends Controller
{
    /**
     * @var ProductServiceInterface
     */
    private ProductServiceInterface $productService;

    /**
     * @param ProductServiceInterface $productService
     */
    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    /**
     * List products
     * @authenticated
     * @queryParam page int The page number. Example: 1
     * @queryParam per_page int The number of items per page. Example: 10
     * @queryParam category_id int The ID of the category. Example: 1
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $serviceResponse = $this->productService->list($request);
        return $this->convertToJsonResponse($serviceResponse);
    }

    /**
     * Show product
     * @authenticated
     * @urlParam id int required The ID of the product. Example: 1
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function show(Request $request, int $id): JsonResponse
    {
        $serviceResponse = $this->productService->find($request, $id);
        return $this->convertToJsonResponse($serviceResponse);
    }
}
