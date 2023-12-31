<?php

namespace App\Actions;

use App\Repositories\Interface\ProductRepositoryInterface;

class DeleteProductAction
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
     * Delete product
     * @param int $id
     * @return bool
     */
    public function handle(int $id): bool
    {
        return $this->productRepository->delete($id);
    }
}
