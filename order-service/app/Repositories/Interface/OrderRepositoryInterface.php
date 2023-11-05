<?php
namespace App\Repositories\Interface;
use App\Constants\OrderStatuses;
use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface OrderRepositoryInterface
{
    /**
     * Get all orders.
     * @param int $page
     * @param int $perPage
     * @param int|null $userId
     * @return LengthAwarePaginator
     */
    public function list(int $page, int $perPage, int $userId = null): LengthAwarePaginator;

    /**
     * Get draft/cart order by user id.
     * @param int $userId
     * @param string $userName
     * @return Order
     */
    public function findCartByUserId(int $userId, string $userName): Order;

    /**
     * Create a new order.
     * @param array $data
     * @return Order
     */
    public function create(array $data): Order;

    /**
     * Update an order status.
     * @param $id
     * @param OrderStatuses $status
     * @return Order
     */
    public function updateStatus($id, OrderStatuses $status): Order;

    /**
     * Update an order.
     * @param $id
     * @param array $data
     * @return Order
     */
    public function update($id, array $data): Order;

    /**
     * Delete an order.
     * @param $id
     * @return bool
     */
    public function delete($id): bool;
}
