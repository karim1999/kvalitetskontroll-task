<?php

namespace App\Actions;

use App\Repositories\Interface\OrderRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CheckProductStockAction
{
    /**
     * @var OrderRepositoryInterface
     */
    private OrderRepositoryInterface $orderRepository;

    /**
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * List orders paginated
     * @param int $page
     * @param int $perPage
     * @param int|null $userId
     * @return LengthAwarePaginator
     */
    public function handle(int $page = 1, int $perPage = 10, int $userId = null): LengthAwarePaginator
    {
        return $this->orderRepository->list($page, $perPage, $userId);
    }
}
