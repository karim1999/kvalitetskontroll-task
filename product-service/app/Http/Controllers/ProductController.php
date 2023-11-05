<?php

namespace App\Http\Controllers;

use App\Actions\CreateProductAction;
use App\Actions\DeleteProductAction;
use App\Actions\ListProductsAction;
use App\Actions\UpdateProductAction;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\ListProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductResourceCollection;
use App\Models\Product;
use Illuminate\Http\Response;

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
        // We can use an action to get a product by id, but it's not necessary
        return new ProductResource($product);
    }

    /**
     * Show product by id
     * @param CreateProductRequest $request
     * @param CreateProductAction $createProductAction
     * @return ProductResource
     */
    public function store(CreateProductRequest $request, CreateProductAction $createProductAction): ProductResource
    {
        $validated = $request->validated();
        $product = $createProductAction->handle($validated);
        return new ProductResource($product);
    }

    /**
     * Show product by id
     * @param Product $product
     * @param UpdateProductRequest $request
     * @param UpdateProductAction $updateProductAction
     * @return ProductResource
     */
    public function update(Product $product, UpdateProductRequest $request, UpdateProductAction $updateProductAction): ProductResource
    {
        $validated = $request->validated();
        $product = $updateProductAction->handle($product->id, $validated);
        return new ProductResource($product);
    }

    /**
     * Delete product by id
     * @param Product $product
     * @param DeleteProductAction $deleteProductAction
     * @return Response
     */
    public function destroy(Product $product, DeleteProductAction $deleteProductAction): Response
    {
        $deleteProductAction->handle($product->id);
        return response()->noContent();
    }
}
