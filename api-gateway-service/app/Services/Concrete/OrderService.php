<?php

namespace App\Services\Concrete;

use App\Services\Interface\OrderServiceInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderService implements OrderServiceInterface
{
    /**
     * @var PendingRequest
     */
    public PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl(config('microservices.order-service.base_uri').':'.config('microservices.order-service.port'))
            ->withHeaders(config('microservices.order-service.headers'));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function list(Request $request): Response
    {
        return $this->client
            ->withHeaders($request->headers->all())
            ->get('/api/orders', $request->all());
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function find(Request $request, int $id): Response
    {
        return $this->client
            ->withHeaders($request->headers->all())
            ->get("/api/orders/{$id}", $request->all());
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function submit(Request $request, int $id): Response
    {
        return $this->client
            ->withHeaders($request->headers->all())
            ->patch("/api/orders/{$id}/submit", $request->all());
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function addToCart(Request $request): Response
    {
        return $this->client
            ->withHeaders($request->headers->all())
            ->patch("/api/add-to-cart", $request->all());
    }
}
