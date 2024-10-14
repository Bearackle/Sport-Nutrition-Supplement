<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        DB::listen(function ($query) {
            logger('SQL: ' . $query->sql); // Log câu lệnh SQL
            logger('Bindings: ' . json_encode($query->bindings)); // Log các bindings
            logger('Time: ' . $query->time . 'ms'); // Log thời gian thực thi
        });
    }
}
