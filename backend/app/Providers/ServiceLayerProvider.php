<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\User\UserService;
use App\Services\Product\ProductService;
use App\Services\Product\CategoryService;
use App\Services\User\UserServiceInterface;
use App\Services\Product\ProductServiceInterface;
use App\Services\Product\CategoryServiceInterface;


class ServiceLayerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(UserServiceInterface::class,UserService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
    }
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
