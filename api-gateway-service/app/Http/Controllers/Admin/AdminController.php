<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Interface\AdminServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Admin Authentication
 *
 * APIs for Admin authentication
 */
class AdminController extends Controller
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
     * Login admin
     * @bodyParam email string required The email of the user. Example: example@gmail.com
     * @bodyParam password string required The password of the user. Example: password
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $serviceResponse = $this->adminService->login($request);
        return $this->convertToJsonResponse($serviceResponse);
    }

    /**
     * Logout user
     * @authenticated
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $serviceResponse = $this->adminService->logout($request);
        return $this->convertToJsonResponse($serviceResponse);
    }

    /**
     * Get admin
     * @authenticated
     * @response {
     * "id": 1,
     * "name": "John Doe",
     * "email": "test@gmail.com",
     * "email_verified_at": null,
     * "created_at": "2021-03-28T12:50:50.000000Z",
     * "updated_at": "2021-03-28T12:50:50.000000Z"
     * }
     * @response 401 {
     * "message": "Unauthenticated."
     * }
     * @param Request $request
     * @return JsonResponse
     */
    public function getUser(Request $request): JsonResponse
    {
        return response()->json($request->admin);
    }
}
