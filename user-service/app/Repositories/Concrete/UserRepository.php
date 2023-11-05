<?php

namespace App\Repositories\Concrete;

use App\Models\User;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return User
     */
    public function create(string $name, string $email, string $password): User
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function getByEmail(string $email): User|null
    {
        return User::where('email', $email)->first();
    }
}
