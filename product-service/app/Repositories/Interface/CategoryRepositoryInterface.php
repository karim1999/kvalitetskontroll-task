<?php
namespace App\Repositories\Interface;
use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CategoryRepositoryInterface
{
    /**
     * Get all categories.
     * @param int $page
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function list(int $page, int $perPage): LengthAwarePaginator;

    /**
     * Get category by id.
     * @param $id
     * @return Category|null
     */
    public function find($id): Category|null;

    /**
     * Create a new category.
     * @param array $data
     * @return Category
     */
    public function create(array $data): Category;

    /**
     * Update an category.
     * @param array $data
     * @param $id
     * @return Category
     */
    public function update(array $data, $id): Category;

    /**
     * Delete an category.
     * @param $id
     * @return bool
     */
    public function delete($id): bool;
}
