<?php

namespace App\Actions;

use App\Constants\OrderStatuses;
use App\Models\Order;
use App\Repositories\Interface\OrderRepositoryInterface;

class SubmitOrderAction
{
    /**
     * @var OrderRepositoryInterface
     */
    private OrderRepositoryInterface $orderRepository;

    /**
     * @var PublishMessageAction
     */
    private PublishMessageAction $publishMessageAction;

    /**
     * @param OrderRepositoryInterface $orderRepository
     * @param PublishMessageAction $publishMessageAction
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        PublishMessageAction $publishMessageAction
    )
    {
        $this->orderRepository = $orderRepository;
        $this->publishMessageAction = $publishMessageAction;
    }

    /**
     * Add product to cart
     * @param int $orderId
     * @param ?string $email
     * @return Order
     */
    public function handle(int $orderId, ?string $email): Order
    {
        // Set order status to COMPLETED
        $order = $this->orderRepository->updateStatus($orderId, OrderStatuses::COMPLETED);

        // Publish order completed message
        $this->publishMessageAction->handle('order_completed', [
            // We can publish other info if needed here
            "order_id" => $orderId,
            "user_id" => $order->user_id,
            "email" => $email,
        ]);
        return $order;
    }
}
