<?php

namespace App\Providers;

use App\Services\Combo\ComboServcie;
use App\Services\Combo\ComboServiceInterface;
use App\Services\ImageService\ImageProductService;
use App\Services\ImageService\ImageProductServiceInterface;
use App\Services\Order\CartService;
use App\Services\Order\CartServiceInterface;
use App\Services\Order\OrderService;
use App\Services\Order\OrderServiceInterface;
use App\Services\Product\BrandServcieInterface;
use App\Services\Product\BrandService;
use App\Services\Product\ProductVariantService;
use App\Services\Product\ProductVariantServiceInterface;
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
        $this->app->bind(BrandServcieInterface::class,BrandService::class);
        $this->app->bind(ProductVariantServiceInterface::class, ProductVariantService::class);
        $this->app->bind(ImageProductServiceInterface::class, ImageProductService::class);
        $this->app->bind(ComboServiceInterface::class, ComboServcie::class);
        $this->app->bind(CartServiceInterface::class,CartService::class);
        $this->app->bind(OrderServiceInterface::class, OrderService::class);
    }
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
