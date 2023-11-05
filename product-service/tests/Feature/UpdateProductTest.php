<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * Test that the update product endpoint returns a successful response.
     */
    public function test_update_product_info_returns_a_successful_response(): void
    {
        $newName = 'Test Product updated';
        $productId = \App\Models\Product::all()->random()->id;
        $response = $this->patch('/api/products/'.$productId, [
            'name' => $newName,
            'description' => 'Test Product Description updated',
            'price' => 100.00,
        ]);
        $response->assertStatus(200);
        $response->assertJsonPath('data.name', $newName);
    }

    /**
     * Test that the update product stock endpoint returns a successful response.
     */
    public function test_update_product_stock_returns_a_successful_response(): void
    {
        $product = \App\Models\Product::all()->random();
        $currentStock = $product->stock;
        $qty = 5;
        $response = $this->patch('/api/products/'.$product->id, [
            'add_to_stock' => $qty,
        ]);
        $response->assertStatus(200);
        $response->assertJsonPath('data.stock', $qty + $currentStock);
    }
}
