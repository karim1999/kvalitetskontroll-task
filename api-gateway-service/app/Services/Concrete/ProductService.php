<?php

namespace App\Services\Concrete;

use App\Services\Interface\ProductServiceInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductService implements ProductServiceInterface
{
    /**
     * @var PendingRequest
     */
    public PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl(config('microservices.product-service.base_uri').':'.config('microservices.product-service.port'))
            ->withHeaders(config('microservices.product-service.headers'));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function list(Request $request): Response
    {
        return $this->client
            ->withHeaders($request->headers->all())
            ->get('/api/products', $request->all());
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
            ->get("/api/products/{$id}", $request->all());
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id): Response
    {
        return $this->client
            ->withHeaders($request->headers->all())
            ->patch("/api/products/{$id}", $request->all());
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        return $this->client
            ->withHeaders($request->headers->all())
            ->post('/api/products', $request->all());
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request, int $id): Response
    {
        return $this->client
            ->withHeaders($request->headers->all())
            ->delete("/api/products/{$id}", $request->all());
    }
}
