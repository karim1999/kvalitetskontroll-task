<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Interface\AdminServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $serviceResponse = $this->adminService->login($request);
        return $this->convertToJsonResponse($serviceResponse);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $serviceResponse = $this->adminService->logout($request);
        return $this->convertToJsonResponse($serviceResponse);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getUser(Request $request): JsonResponse
    {
        return response()->json($request->admin);
    }
}
