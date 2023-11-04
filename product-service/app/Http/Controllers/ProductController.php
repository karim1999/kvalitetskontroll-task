<?php

namespace App\Http\Controllers;

use App\Actions\ListProductsAction;
use App\Http\Requests\ListProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductResourceCollection;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * List products paginated
     * @param ListProductRequest $request
     * @param ListProductsAction $listProductsAction
     * @return ProductResourceCollection
     */
    public function index(ListProductRequest $request, ListProductsAction $listProductsAction): ProductResourceCollection
    {
        $validated = $request->validated();
        $page = $validated['page'] ?? 1;
        $perPage = $validated['per_page'] ?? 10;
        $categoryId = $validated['category_id'] ?? null;
        $data = $listProductsAction->handle($page, $perPage, $categoryId);
        return new ProductResourceCollection($data);
    }

    /**
     * Show product by id
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product): ProductResource
    {
        // We can use an action to get an product by id, but it's not necessary
        return new ProductResource($product);
    }
}
