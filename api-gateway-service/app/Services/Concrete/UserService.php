<?php

namespace App\Services\Concrete;

use App\Services\Interface\UserServiceInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserService implements UserServiceInterface
{
    /**
     * @var PendingRequest
     */
    public PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl(config('microservices.user-service.base_uri').':'.config('microservices.user-service.port'))
            ->withHeaders(config('microservices.user-service.headers'));
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
    public function register(Request $request): Response
    {
        return $this->client
            ->withHeaders($request->headers->all())
            ->post('/api/register', $request->all());
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
    public function getUserByToken(string $token): Response
    {
        return $this->client
            ->withHeader('Authorization', 'Bearer ' . $token)
            ->get('/api/user');
    }
}
