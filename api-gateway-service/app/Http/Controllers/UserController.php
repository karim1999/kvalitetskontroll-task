<?php

namespace App\Http\Controllers;

use App\Services\Interface\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
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
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $serviceResponse = $this->userService->login($request);
        return $this->convertToJsonResponse($serviceResponse);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $serviceResponse = $this->userService->register($request);
        return $this->convertToJsonResponse($serviceResponse);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $serviceResponse = $this->userService->logout($request);
        return $this->convertToJsonResponse($serviceResponse);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getUser(Request $request): JsonResponse
    {
        return response()->json($request->user);
    }
}
