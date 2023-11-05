<?php

namespace App\Actions;

use App\Repositories\Interface\UserRepositoryInterface;

class RegisterUserAction
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
     * @param string $name
     * @param string $email
     * @param string $password
     * @return array
     */
    public function handle(string $name, string $email, string $password): array
    {
        $user = $this->userRepository->create($name, $email, $password);
        $token = $user->createToken('auth_token')->plainTextToken;
        return [
            'user' => $user,
            'token' => $token
        ];
    }
}
