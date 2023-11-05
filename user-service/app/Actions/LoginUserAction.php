<?php

namespace App\Actions;

use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class LoginUserAction
{
    /**
     * @var UserRepositoryInterface
     */
    public UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $email
     * @param string $password
     * @return array|null
     */
    public function handle(string $email, string $password): array|null
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = $this->userRepository->getByEmail($email);
            $token = $user->createToken('auth_token')->plainTextToken;
            return [
                'user' => $user,
                'token' => $token
            ];
        }
        return null;
    }
}
