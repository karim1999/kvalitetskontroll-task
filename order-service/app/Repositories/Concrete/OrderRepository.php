<?php

namespace App\Repositories\Concrete;

use App\Constants\OrderStatuses;
use App\Models\Order;
use App\Repositories\Interface\OrderRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * Get all orders.
     * @param int $page
     * @param int $perPage
     * @param int|null $userId
     * @return LengthAwarePaginator
     */
    public function list(int $page, int $perPage, int $userId = null): LengthAwarePaginator
    {
        $orders = Order::query()->with(['items']);
        if ($userId) {
            $orders->where('user_id', $userId);
        }
        return $orders->paginate($perPage, ['*'], 'page', $page);
    }

    /**
     * Get draft/cart order by user id.
     * @param int $userId
     * @param string $userName
     * @return Order
     */
    public function findCartByUserId(int $userId, string $userName): Order
    {
        return Order::firstOrCreate([
            'user_id' => $userId,
            'status' => OrderStatuses::PENDING,
        ], [
            'customer_name' => $userName,
        ]);
    }

    /**
     * Create a new order.
     * @param array $data
     * @return Order
     */
    public function create(array $data): Order
    {
        // TODO: Implement create() method.
    }

    /**
     * Update an order status.
     * @param $id
     * @param OrderStatuses $status
     * @return Order
     */
    public function updateStatus($id, OrderStatuses $status): Order
    {
        $order = Order::findOrFail($id);
        $order->status = $status;
        $order->save();
        return $order;
    }

    /**
     * Update an order.
     * @param $id
     * @param array $data
     * @return Order
     */
    public function update($id, array $data): Order
    {
        // TODO: Implement update() method.
    }

    /**
     * Delete an order.
     * @param $id
     * @return bool
     */
    public function Delete($id): bool
    {
        // TODO: Implement all() method.
    }
}
