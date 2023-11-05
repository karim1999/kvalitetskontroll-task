<?php

namespace App\Repositories\Concrete;

use App\Models\Product;
use App\Repositories\Interface\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Get all products.
     * @param int $page
     * @param int $perPage
     * @param int|null $userId
     * @return LengthAwarePaginator
     */
    public function list(int $page, int $perPage, int $userId = null): LengthAwarePaginator
    {
        $products = Product::query()->with(['category']);
        if ($userId) {
            $products->where('category_id', $userId);
        }
        return $products->paginate($perPage, ['*'], 'page', $page);
    }

    /**
     * Get product by id.
     * @param int $id
     * @return Product|null
     */
    public function find(int $id): Product|null
    {
        return Product::find($id);
    }

    /**
     * Create a new product.
     * @param array $data
     * @return Product
     */
    public function create(array $data): Product
    {
        return Product::create($data);
    }

    /**
     * Update an product.
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return Product::where('id', $id)->update($data);
    }

    /**
     * Delete an product.
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        return Product::where('id', $id)->delete();
    }

    /**
     * Add stocks to the product + -.
     * @param $id
     * @param int $quantity
     * @return Product
     */
    public function addProductStock($id, int $quantity): Product
    {
        $product = Product::lockForUpdate()->find($id);
        $product->stock += $quantity;
        $product->save();
        return $product;
    }
}
