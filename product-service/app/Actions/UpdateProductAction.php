<?php

namespace App\Actions;

use App\Models\Product;
use App\Repositories\Interface\ProductRepositoryInterface;

class UpdateProductAction
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
     * @param int $id
     * @param string $name
     * @param string $description
     * @param $price
     * @param int $categoryId
     * @param int $stockToAdd
     * @return Product
     */
    public function handle(int $id, string $name, string $description, $price, int $categoryId, int $stockToAdd): Product
    {
        $product = $this->productRepository->update($id, [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'category_id' => $categoryId,
        ]);
        if ($stockToAdd){
            $product = $this->productRepository->addProductStock($id, $stockToAdd);
        }
        return $product;
    }
}
