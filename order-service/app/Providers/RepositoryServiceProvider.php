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
            'App\Repositories\Interface\OrderRepositoryInterface',
            'App\Repositories\Concrete\OrderRepository'
        );
        $this->app->bind(
            'App\Repositories\Interface\OrderItemRepositoryInterface',
            'App\Repositories\Concrete\OrderItemRepository'
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
