<?php

namespace App\Repositories\Concrete;

use App\Models\Category;
use App\Repositories\Interface\CategoryRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * Get all categories.
     * @param int $page
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function list(int $page, int $perPage): LengthAwarePaginator
    {
        $categories = Category::query();
        return $categories->paginate($perPage, ['*'], 'page', $page);
    }

    /**
     * Get category by id.
     * @param $id
     * @return Category|null
     */
    public function find($id): Category|null
    {
        // TODO: Implement all() method.
    }

    /**
     * Create a new category.
     * @param array $data
     * @return Category
     */
    public function create(array $data): Category
    {
        // TODO: Implement all() method.
    }

    /**
     * Update an category.
     * @param array $data
     * @param $id
     * @return Category
     */
    public function update(array $data, $id): Category
    {
        // TODO: Implement all() method.
    }

    /**
     * Delete an category.
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        // TODO: Implement all() method.
    }
}
