<?php

namespace App\Jobs;

use App\Actions\AddProductToOrderAction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProductStockCheckedJob implements ShouldQueue
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
     * @var bool
     */
    public bool $isAvailable;

    /**
     * @var float
     */
    public float $price;

    /**
     * @var string
     */
    public string $productName;

    /**
     * Create a new event instance.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->productId = $data['product_id'];
        $this->quantity = $data['quantity'];
        $this->orderId = $data['order_id'];
        $this->isAvailable = $data['is_available'];
        $this->price = $data['price'];
        $this->productName = $data['product_name'];
    }

    /**
     * Execute the job.
     */
    public function handle(AddProductToOrderAction $addProductToOrderAction): void
    {
        $addProductToOrderAction->finish(
            $this->orderId,
            $this->productId,
            $this->quantity,
            $this->isAvailable,
            $this->price,
            $this->productName
        );
    }
}
