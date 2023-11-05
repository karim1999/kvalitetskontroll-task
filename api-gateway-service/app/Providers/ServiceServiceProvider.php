<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Services\Interface\UserServiceInterface::class,
            \App\Services\Concrete\UserService::class
        );
        $this->app->bind(
            \App\Services\Interface\AdminServiceInterface::class,
            \App\Services\Concrete\AdminService::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
