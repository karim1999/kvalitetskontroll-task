<?php

namespace App\Actions;

use App\Repositories\Interface\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListProductsAction
{
    /**
     * @var ProductRepositoryInterface
     */
    private ProductRepositoryInterface $productRepository;

    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * List products paginated
     * @param int $page
     * @param int $perPage
     * @param int|null $category_id
     * @return LengthAwarePaginator
     */
    public function handle(int $page = 1, int $perPage = 10, int $category_id = null): LengthAwarePaginator
    {
        return $this->productRepository->list($page, $perPage, $category_id);
    }
}
