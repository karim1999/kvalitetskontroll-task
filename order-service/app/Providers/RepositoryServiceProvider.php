<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\Interface\OrderRepositoryInterface::class,
            \App\Repositories\Concrete\OrderRepository::class
        );
        $this->app->bind(
            \App\Repositories\Interface\OrderItemRepositoryInterface::class,
            \App\Repositories\Concrete\OrderItemRepository::class
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
