<?php

namespace App\Actions;

use App\Models\Product;
use App\Repositories\Interface\ProductRepositoryInterface;

class CreateProductAction
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
     * Create product
     * @param array $data
     * @return Product
     */
    public function handle(array $data): Product
    {
        return $this->productRepository->create($data);
    }
}
