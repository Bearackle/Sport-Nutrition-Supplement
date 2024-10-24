<?php

namespace App\Providers;

use App\Repositories\Address\AddressRepository;
use App\Repositories\Address\AddressRepositoryInterface;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\Cart\CartItemRepository;
use App\Repositories\Cart\CartItemRepositoryInterface;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Combo\ComboProductRepository;
use App\Repositories\Combo\ComboProductRepositoryInterface;
use App\Repositories\Combo\ComboRepository;
use App\Repositories\Combo\ComboRepositoryInterface;
use App\Repositories\Image\ProductImageRepository;
use App\Repositories\Image\ProductImageRepositoryInterface;
use App\Repositories\Image\RatingImageRepository;
use App\Repositories\Image\RatingImageRepositoryInterface;
use App\Repositories\Order\OrderDetailRepository;
use App\Repositories\Order\OrderDetailRepositoryInterface;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Payment\PaymentRepository;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Product\ProductVariantRepository;
use App\Repositories\Product\ProductVariantRepositoryInterface;
use App\Repositories\Review\ReviewRepository;
use App\Repositories\Review\ReviewRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BrandRepositoryInterface::class , BrandRepository::class);
        $this->app->bind(CartItemRepositoryInterface::class, CartItemRepository::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ComboProductRepositoryInterface::class, ComboProductRepository::class);
        $this->app->bind(ComboRepositoryInterface::class, ComboRepository::class);
        $this->app->bind(OrderDetailRepositoryInterface::class, OrderDetailRepository::class);
        $this->app->bind(OrderRepositoryInterface::class,OrderRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class,PaymentRepository::class);
        $this->app->bind(ProductRepositoryInterface::class,ProductRepository::class);
        $this->app->bind(ProductVariantRepositoryInterface::class,ProductVariantRepository::class);
        $this->app->bind(ReviewRepositoryInterface::class,ReviewRepository::class);
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(ProductImageRepositoryInterface::class,ProductImageRepository::class);
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
        $this->app->bind(RatingImageRepositoryInterface::class, RatingImageRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
