<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Interface\ProductServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $serviceResponse = $this->productService->list($request);
        return $this->convertToJsonResponse($serviceResponse);
    }

    /**
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
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $serviceResponse = $this->productService->create($request);
        return $this->convertToJsonResponse($serviceResponse);
    }

    /**
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
