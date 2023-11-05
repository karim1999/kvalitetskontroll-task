<?php

namespace App\Actions;

use App\Repositories\Interface\OrderItemRepositoryInterface;
use App\Repositories\Interface\OrderRepositoryInterface;

class AddProductToOrderAction
{
    /**
     * @var OrderRepositoryInterface
     */
    private OrderRepositoryInterface $orderRepository;

    /**
     * @var OrderItemRepositoryInterface
     */
    private OrderItemRepositoryInterface $orderItemRepository;

    /**
     * @var PublishMessageAction
     */
    private PublishMessageAction $publishMessageAction;

    /**
     * @param OrderRepositoryInterface $orderRepository
     * @param OrderItemRepositoryInterface $orderItemRepository
     * @param PublishMessageAction $publishMessageAction
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        OrderItemRepositoryInterface $orderItemRepository,
        PublishMessageAction $publishMessageAction
    )
    {
        $this->orderRepository = $orderRepository;
        $this->publishMessageAction = $publishMessageAction;
        $this->orderItemRepository = $orderItemRepository;
    }

    /**
     * Add product to cart
     * @param int $userId
     * @param int $productId
     * @param int $quantity
     * @param string $userName
     * @return void
     */
    public function handle(int $userId, int $productId, int $quantity, string $userName)
    {
        // Get order by user_id and status = pending (cart)
        // If not exists, create new order
        $order = $this->orderRepository->findCartByUserId($userId, $userName);
        // Publish event to check Product Availability
        $this->publishMessageAction->handle('product_stock_check', [
            "product_id" => $productId,
            "quantity" => $quantity,
            "order_id" => $order->id,
        ]);
    }

    /**
     * Add product to cart
     * @param int $orderId
     * @param int $productId
     * @param int $quantity
     * @param bool $isAvailable
     * @param $price
     * @param string $productName
     * @return void
     */
    public function finish(int $orderId, int $productId, int $quantity, bool $isAvailable, $price, string $productName): void
    {
        // If product is not available, we should send a notification to the client telling him that the product is not available
        if (!$isAvailable) {
            return;
        }
        // Add product to order
        $this->orderItemRepository->addProduct(
            $orderId,
            $productId,
            $quantity,
            $price,
            $productName
        );
    }
}
