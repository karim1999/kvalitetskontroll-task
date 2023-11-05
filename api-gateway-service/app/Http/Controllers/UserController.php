<?php

namespace App\Http\Controllers;

use App\Services\Interface\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group User Authentication
 *
 * APIs for users Authentication
 */
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
     * Login user
     * @bodyParam email string required The email of the user. Example: example@gmail.com
     * @bodyParam password string required The password of the user. Example: password
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $serviceResponse = $this->userService->login($request);
        return $this->convertToJsonResponse($serviceResponse);
    }

    /**
     * Register user
     * @bodyParam name string required The name of the user. Example: John Doe
     * @bodyParam email string required The email of the user. Example: example@gmail.com
     * @bodyParam password string required The password of the user. Example: password
     * @bodyParam password_confirmation string required The password confirmation of the user. Example: password
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $serviceResponse = $this->userService->register($request);
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
        $serviceResponse = $this->userService->logout($request);
        return $this->convertToJsonResponse($serviceResponse);
    }

    /**
     * Get user
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
        return response()->json($request->user);
    }
}
