<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListProductsTest extends TestCase
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
     * Test that the list products endpoint returns a successful response.
     */
    public function test_list_products_returns_a_successful_response(): void
    {
        $response = $this->get('/api/products');
        $response->assertStatus(200);
    }

    /**
     * Test that the list products endpoint paginated results returns the right number of products.
     */
    public function test_list_products_returns_the_right_number_of_products(): void
    {
        $page = 2;
        $perPage = 5;
        $response = $this->get('/api/products?page=' . $page . '&per_page=' . $perPage);
        $response->assertStatus(200);
        $this->assertEquals($perPage, count($response->json()['data']));
    }

    /**
     * Test that the list products by category endpoint returns a successful response.
     */
    public function test_list_products_by_category_returns_the_right_number_of_products(): void
    {
        $categoryId = \App\Models\Category::all()->random()->id;
        $response = $this->get('/api/products?category_id=' . $categoryId);
        $response->assertStatus(200);
        $this->assertEquals(5, count($response->json()['data']));
    }
}
