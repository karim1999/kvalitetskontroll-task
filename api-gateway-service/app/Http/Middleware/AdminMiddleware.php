<?php

namespace App\Http\Middleware;

use App\Services\Interface\AdminServiceInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * @var AdminServiceInterface
     */
    private AdminServiceInterface $adminService;

    /**
     * @param AdminServiceInterface $adminService
     */
    public function __construct(AdminServiceInterface $adminService)
    {
        $this->adminService = $adminService;
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
            $response = $this->adminService->getAdminByToken($token);
            if ($response->successful()) {
                $admin = $response->json();
                // add admin to the request
                $request->merge(['admin'=> $admin, 'admin_id' => $admin['id']]);
                return $next($request);
            }
        }
        abort(401, 'Unauthorized');
    }
}
