<?php

namespace App\Repositories\Concrete;

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
     * Get order by id.
     * @param $id
     * @return Order|null
     */
    public function find($id): Order|null
    {
        // TODO: Implement all() method.
    }

    /**
     * Create a new order.
     * @param array $data
     * @return Order
     */
    public function create(array $data): Order
    {
        // TODO: Implement all() method.
    }

    /**
     * Update an order.
     * @param array $data
     * @param $id
     * @return Order
     */
    public function update(array $data, $id): Order
    {
        // TODO: Implement all() method.
    }

    /**
     * Delete an order.
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        // TODO: Implement all() method.
    }
}
