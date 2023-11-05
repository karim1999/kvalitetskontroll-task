<?php

namespace App\Jobs;

use App\Actions\CheckProductStockAction;
use App\Actions\GetProductAction;
use App\Actions\PublishMessageAction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckProductStockJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    public int $productId;
    /**
     * @var int
     */
    public int $quantity;
    /**
     * @var int
     */
    public int $orderId;

    /**
     * Create a new event instance.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->productId = $data['product_id'] ?? null;
        $this->quantity = $data['quantity'] ?? null;
        $this->orderId = $data['order_id'] ?? null;
    }

    /**
     * Execute the job.
     * @param CheckProductStockAction $checkProductStockAction
     * @param PublishMessageAction $publishMessageAction
     */
    public function handle(CheckProductStockAction $checkProductStockAction, GetProductAction $getProductAction, PublishMessageAction $publishMessageAction): void
    {
        $isAvailable = $checkProductStockAction->handle($this->productId, $this->quantity);
        $product = $getProductAction->handle($this->productId);
        $publishMessageAction->handle('product_stock_checked', [
            'product_id' => $this->productId,
            'quantity' => $this->quantity,
            'order_id' => $this->orderId,
            'is_available' => $isAvailable,
            'product_name' => $product->name,
            'price' => $product->price,
        ]);
    }
}
