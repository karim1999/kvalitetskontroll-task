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
            \App\Repositories\Interface\ProductRepositoryInterface::class,
            \App\Repositories\Concrete\ProductRepository::class
        );
        $this->app->bind(
            \App\Repositories\Interface\CategoryRepositoryInterface::class,
            \App\Repositories\Concrete\CategoryRepository::class
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
