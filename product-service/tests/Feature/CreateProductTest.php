<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateProductTest extends TestCase
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
     * Test that the create product endpoint returns a successful response.
     */
    public function test_create_product_returns_a_successful_response(): void
    {
        $price = 9.99;
        $response = $this->post('/api/products', [
            'name' => 'Test Product',
            'description' => 'Test Product Description',
            'price' => $price,
            'category_id' => 1,
            'stock' => 10,
        ]);
        $response->assertStatus(201);
        $response->assertJsonPath('data.price', $price);
    }

    /**
     * Test that the create product endpoint validation.
     */
    public function test_create_product_validation(): void
    {
        $response = $this->post('/api/products', [
            'description' => 'Test Product Description',
            'price' => 9.99,
            'category_id' => 1,
            'stock' => 10,
        ]);
        $response->assertStatus(422);
    }
}
