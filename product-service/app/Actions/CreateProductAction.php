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
     * List products paginated
     * @param string $name
     * @param string $description
     * @param $price
     * @param int $categoryId
     * @param int $stock
     * @return Product
     */
    public function handle(string $name, string $description, $price, int $categoryId, int $stock): Product
    {
        return $this->productRepository->create([
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'category_id' => $categoryId,
            'stock' => $stock,
        ]);
    }
}
