<?php


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListOrdersTest extends TestCase
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
     * Test that the list orders endpoint returns a successful response.
     */
    public function test_list_orders_returns_a_successful_response(): void
    {
        $response = $this->get('/api/orders');
        $response->assertStatus(200);
    }

    /**
     * Test that the list orders endpoint paginated results returns the right number of orders.
     */
    public function test_list_orders_returns_the_right_number_of_orders(): void
    {
        $page = 2;
        $perPage = 5;
        $response = $this->get('/api/orders?page=' . $page . '&per_page=' . $perPage);
        $response->assertStatus(200);
        $this->assertEquals($perPage, count($response->json()['data']));
    }

    /**
     * Test that the list orders by user endpoint returns a successful response.
     */
    public function test_list_orders_by_user_returns_the_right_number_of_orders(): void
    {
        $userId = \App\Models\Order::all()->random()->user_id;
        $response = $this->get('/api/orders?user_id=' . $userId);
        $response->assertStatus(200);
        $actualCount = \App\Models\Order::where('user_id', $userId)->count();
        $this->assertEquals($actualCount, count($response->json()['data']));
    }
}
