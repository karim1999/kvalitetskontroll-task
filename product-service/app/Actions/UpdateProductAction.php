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
     * Update product
     * @param int $id
     * @param array $data
     * @return Product
     */
    public function handle(int $id, array $data): Product
    {
        if (isset($data['add_to_stock'])){
            $this->productRepository->addProductStock($id, $data['add_to_stock']);
            unset($data['add_to_stock']);
        }
        $this->productRepository->update($id, $data);
        return $this->productRepository->find($id);
    }
}
