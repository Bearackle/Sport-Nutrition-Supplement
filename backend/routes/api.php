<?php

use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group([
    'prefix' => 'account'
],function(){
    Route::post('login',[UserController::class,'login'])->name('login');
    Route::post('register',[UserController::class,'register']);
    Route::get('profile',[UserController::class,'show'])
    ->middleware('auth:sanctum');
    Route::put('updatepassword',[UserController::class,'update'])
    ->middleware('auth:sanctum');
});

Route::group([
    'prefix' => 'collection'
],function(){
    Route::get('all',[ProductController::class,'allProducts']);
});

Route::group([
    'prefix' => 'products'
],function(){
    Route::post('create', [ProductController::class,'store']);
//        ->middleware('auth:sanctum');
    Route::get('/{id}',[ProductController::class,'show']);
});

Route::group([
    'prefix' => 'categories'
],function(){
    Route::get('/all',[CategoryController::class,'index']);
    Route::get('/top_products',[CategoryController::class,'getTopProductCategories']);
});

Route::group([
    'prefix' => 'brands'
],function (){
    Route::get('/all',[BrandController::class,'index']);
});

