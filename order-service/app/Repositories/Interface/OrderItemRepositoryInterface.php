<?php
namespace App\Repositories\Interface;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Collection;

interface OrderItemRepositoryInterface
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
    public function addProduct(int $orderId, int $productId, int $quantity, float $price, string $productName): OrderItem;

    /**
     * Get all order items.
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Get order item by id.
     * @param $id
     * @return OrderItem|null
     */
    public function find($id): OrderItem|null;

    /**
     * Create a new order item.
     * @param array $data
     * @return OrderItem
     */
    public function create(array $data): OrderItem;

    /**
     * Update an order item.
     * @param array $data
     * @param $id
     * @return OrderItem
     */
    public function update(array $data, $id): OrderItem;

    /**
     * Delete an order item.
     * @param $id
     * @return bool
     */
    public function delete($id): bool;
}
