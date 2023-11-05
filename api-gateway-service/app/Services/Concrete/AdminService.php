<?php

namespace App\Services\Concrete;

use App\Services\Interface\AdminServiceInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminService implements AdminServiceInterface
{
    /**
     * @var PendingRequest
     */
    public PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl(config('microservices.admin-service.base_uri').':'.config('microservices.admin-service.port'))
            ->withHeaders(config('microservices.admin-service.headers'));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function login(Request $request): Response
    {
        return $this->client
            ->withHeaders($request->headers->all())
            ->post('/api/login', $request->all());
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function logout(Request $request): Response
    {
        return $this->client
            ->withHeaders($request->headers->all())
            ->post('/api/logout', $request->all());
    }

    /**
     * @param string $token
     * @return Response
     */
    public function getAdminByToken(string $token): Response
    {
        return $this->client
            ->withHeader('Authorization', 'Bearer ' . $token)
            ->get('/api/user');
    }
}
