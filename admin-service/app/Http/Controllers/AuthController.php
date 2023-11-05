<?php

namespace App\Http\Controllers;

use App\Actions\LoginUserAction;
use App\Actions\LogoutUserAction;
use App\Actions\RegisterUserAction;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\RegisterResource;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @param RegisterUserAction $registerUserAction
     * @return RegisterResource
     */
    public function register(RegisterRequest $request, RegisterUserAction $registerUserAction): RegisterResource
    {
        $data = $request->validated();
        $name = $data['name'];
        $email = $data['email'];
        $password = $data['password'];
        return new RegisterResource($registerUserAction->handle($name, $email, $password));
    }

    /**
     * @param LoginRequest $request
     * @param LoginUserAction $loginUserAction
     * @return LoginResource
     */
    public function login(LoginRequest $request, LoginUserAction $loginUserAction)
    {
        $data = $request->validated();
        $email = $data['email'];
        $password = $data['password'];
        return new LoginResource($loginUserAction->handle($email, $password));
    }

    /**
     * @param LogoutUserAction $logoutUserAction
     * @return Response
     */
    public function logout(LogoutUserAction $logoutUserAction): Response
    {
        $logoutUserAction->handle();
        return response()->noContent();
    }
}
