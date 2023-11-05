<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Interface\ProductServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Admin Product management
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

    /**
     * Create product
     * @authenticated
     * @bodyParam name string required The name of the product. Example: Product 1
     * @bodyParam description string required The description of the product. Example: Product 1 description
     * @bodyParam price float required The price of the product. Example: 10.00
     * @bodyParam category_id int required The ID of the category. Example: 1
     * @bodyParam stock the quantity of the product. Example: 3
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $serviceResponse = $this->productService->create($request);
        return $this->convertToJsonResponse($serviceResponse);
    }

    /**
     * Update product
     * @authenticated
     * @urlParam id int required The ID of the product. Example: 1
     * @bodyParam name string required The name of the product. Example: Product 1
     * @bodyParam description string required The description of the product. Example: Product 1 description
     * @bodyParam price float required The price of the product. Example: 10.00
     * @bodyParam category_id int required The ID of the category. Example: 1
     * @bodyParam add_to_stock the quantity to add to the product. Example: 3, -3
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $serviceResponse = $this->productService->update($request, $id);
        return $this->convertToJsonResponse($serviceResponse);
    }

    /**
     * Delete product
     * @authenticated
     * @urlParam id int required The ID of the product. Example: 1
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(Request $request, int $id): JsonResponse
    {
        $serviceResponse = $this->productService->destroy($request, $id);
        return $this->convertToJsonResponse($serviceResponse);
    }
}
