<?php

namespace App\Actions;

use App\Models\Product;
use App\Repositories\Interface\ProductRepositoryInterface;

class GetProductAction
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
     * @return Product
     */
    public function handle(int $id): Product
    {
        return $this->productRepository->find($id);
    }
}
