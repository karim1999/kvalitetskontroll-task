<?php
namespace App\Repositories\Interface;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    /**
     * Get all products.
     * @param int $page
     * @param int $perPage
     * @param int|null $userId
     * @return LengthAwarePaginator
     */
    public function list(int $page, int $perPage, int $userId = null): LengthAwarePaginator;

    /**
     * Get product by id.
     * @param $id
     * @return Product|null
     */
    public function find($id): Product|null;

    /**
     * Create a new product.
     * @param array $data
     * @return Product
     */
    public function create(array $data): Product;

    /**
     * Update an product.
     * @param array $data
     * @param $id
     * @return Product
     */
    public function update(array $data, $id): Product;

    /**
     * Delete an product.
     * @param $id
     * @return bool
     */
    public function delete($id): bool;
}
