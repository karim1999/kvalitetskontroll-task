<?php


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubmitOrderTest extends TestCase
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
     * Test that the list orders endpoint returns a successful response.
     */
    public function test_submit_order_returns_a_successful_response(): void
    {
        $order = \App\Models\Order::factory()->pending()->create();
        $response = $this->post("/api/orders/{$order->id}/submit");
        $response->assertStatus(200);
    }
}
