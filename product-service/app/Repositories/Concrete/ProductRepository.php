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
     * @param $id
     * @return Product|null
     */
    public function find($id): Product|null
    {
        // TODO: Implement all() method.
    }

    /**
     * Create a new product.
     * @param array $data
     * @return Product
     */
    public function create(array $data): Product
    {
        // TODO: Implement all() method.
    }

    /**
     * Update an product.
     * @param array $data
     * @param $id
     * @return Product
     */
    public function update(array $data, $id): Product
    {
        // TODO: Implement all() method.
    }

    /**
     * Delete an product.
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        // TODO: Implement all() method.
    }
}
