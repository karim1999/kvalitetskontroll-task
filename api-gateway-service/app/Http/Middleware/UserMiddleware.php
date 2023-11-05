<?php

namespace App\Http\Middleware;

use App\Services\Interface\UserServiceInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * @var UserServiceInterface
     */
    private UserServiceInterface $userService;

    /**
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        if ($token) {
            $response = $this->userService->getUserByToken($token);
            if ($response->successful()) {
                $user = $response->json();
                // add user to the request
                $request->merge(['user'=> $user, 'user_id' => $user['id']]);
                return $next($request);
            }
        }
        abort(401, 'Unauthorized');
    }
}
