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
            'App\Repositories\Interface\ProductRepositoryInterface',
            'App\Repositories\Concrete\ProductRepository'
        );
        $this->app->bind(
            'App\Repositories\Interface\CategoryRepositoryInterface',
            'App\Repositories\Concrete\CategoryRepository'
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
