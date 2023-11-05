<?php

namespace App\Repositories\Concrete;

use App\Models\OrderItem;
use App\Repositories\Interface\OrderItemRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class OrderItemRepository implements OrderItemRepositoryInterface
{
    /**
     * Add product to order/cart.
     * @param int $orderId
     * @param int $productId
     * @param int $quantity
     * @param float $price
     * @param string $productName
     * @return OrderItem
     */
    public function addProduct(int $orderId, int $productId, int $quantity, float $price, string $productName): OrderItem
    {
        return OrderItem::updateOrCreate([
            'order_id' => $orderId,
            'product_id' => $productId,
        ], [
            'quantity' => $quantity,
            'price' => $price,
            'product_name' => $productName,
        ]);
    }

    /**
     * Get all order items.
     * @return Collection
     */
    public function all(): Collection
    {
        // TODO: Implement all() method.
    }

    /**
     * Get order item by id.
     * @param $id
     * @return OrderItem|null
     */
    public function find($id): OrderItem|null
    {
        // TODO: Implement all() method.
    }

    /**
     * Create a new order item.
     * @param array $data
     * @return OrderItem
     */
    public function create(array $data): OrderItem
    {
        // TODO: Implement all() method.
    }

    /**
     * Update an order item.
     * @param array $data
     * @param $id
     * @return OrderItem
     */
    public function update(array $data, $id): OrderItem
    {
        // TODO: Implement all() method.
    }

    /**
     * Delete an order item.
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        // TODO: Implement all() method.
    }
}
