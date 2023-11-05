<?php

namespace App\Actions;

class LogoutUserAction
{
    /**
     * @return bool
     */
    public function handle(): bool
    {
        request()->session()->flush();
        request()->user()->tokens()->delete();
        return true;
    }
}
