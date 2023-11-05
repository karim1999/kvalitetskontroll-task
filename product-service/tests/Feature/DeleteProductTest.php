<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test that a product can be deleted.
     */
    public function test_delete_product_returns_a_successful_response(): void
    {
        $this->seed();
        $productId = \App\Models\Product::all()->random()->id;
        $response = $this->delete("/api/products/{$productId}");
        $response->assertStatus(204);
    }

    /**
     * Test that a product can be deleted.
     */
    public function test_delete_non_existent_product_returns_not_found_response(): void
    {
        $response = $this->delete("/api/products/1");
        $response->assertStatus(404);
    }
}
