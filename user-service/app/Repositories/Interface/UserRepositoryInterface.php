<?php
namespace App\Repositories\Interface;
use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return User
     */
    public function create(string $name, string $email, string $password): User;

    /**
     * @param string $email
     * @return User|null
     */
    public function getByEmail(string $email): User|null;
}
