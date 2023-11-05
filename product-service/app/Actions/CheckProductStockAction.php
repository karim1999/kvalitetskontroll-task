<?php

namespace App\Actions;

use App\Repositories\Interface\ProductRepositoryInterface;

class CheckProductStockAction
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
     * Check product stock
     * @param int $id
     * @param int $quantity
     * @return bool
     */
    public function handle(int $id, int $quantity): bool
    {
        $product = $this->productRepository->find($id);
        return $product->stock >= $quantity;
    }
}
