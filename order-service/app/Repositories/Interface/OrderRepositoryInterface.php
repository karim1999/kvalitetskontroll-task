<?php
namespace App\Repositories\Interface;
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
     * Get order by id.
     * @param $id
     * @return Order|null
     */
    public function find($id): Order|null;

    /**
     * Create a new order.
     * @param array $data
     * @return Order
     */
    public function create(array $data): Order;

    /**
     * Update an order.
     * @param array $data
     * @param $id
     * @return Order
     */
    public function update(array $data, $id): Order;

    /**
     * Delete an order.
     * @param $id
     * @return bool
     */
    public function delete($id): bool;
}
