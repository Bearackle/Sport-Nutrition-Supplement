<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ComboController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductVariantController;
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
    Route::get('category/{id}',[ProductController::class,'CategoryProduct']);
    Route::get('products', [ProductController::class,'filter']);
});
Route::group([
    'prefix' => 'products'
],function(){
    Route::post('create', [ProductController::class,'store']);
    Route::get('/{id}',[ProductController::class,'show']);
    Route::delete('/{id}',[ProductController::class,'destroy']);
    // variants
    Route::get('/{id}/variants',[ProductVariantController::class,'VariantsOfProduct']);
    Route::post('/variants',[ProductVariantController::class,'store']);
    Route::delete('/variants/{id}',[ProductVariantController::class,'destroy']);
});

Route::group([
    'prefix' => 'categories'
],function(){
    Route::get('/all',[CategoryController::class,'index']);
    Route::get('/top_products',[CategoryController::class,'getTopProductCategories']);
    Route::get('children/{id}',[CategoryController::class,'ChildrenCategories']);
});
Route::group([
    'prefix' => 'brands'
],function (){
    Route::get('/all',[BrandController::class,'index']);
});
Route::group([
    'prefix' => 'combo'
],function(){
    Route::get('/{id}',[ComboController::class,'show']);
    Route::get('all',[ComboController::class,'index']);
    Route::post('create',[ComboController::class,'store']);
    Route::post('add',[ComboController::class,'add']);
    Route::delete('/{id}',[ComboController::class,'destroy']);
});

Route::group([
    'prefix' => 'cart'],
    function() {
        Route::get('all', [CartController::class, 'show']);
        Route::get('/{id}', [CartController::class, 'index']);
        Route::post('new', [CartController::class, 'newCart']);
        Route::post('item',[CartController::class,'store']);;
        Route::delete('item',[CartController::class,'destroy']);
        Route::put('item',[CartController::class,'update']);
    });
Route::group([
    'prefix' => 'order'],function(){
    Route::get('all',[OrderController::class,'index']);
    Route::get('/',[OrderController::class,'show']);
    Route::post('create',[OrderController::class,'store']);
    Route::put('status',[OrderController::class,'update']);
    Route::delete('/',[OrderController::class,'destroy'] );
    Route::post('payment',[OrderController::class,'addPayment']);
    Route::post('address',[OrderController::class,'addAddress']);
    Route::post('ship', [OrderController::class,'addShipping']);
});

Route::group([
    'prefix' => 'address'
], function(){
    Route::get('/',[AddressController::class,'show']);
    Route::get('default',[AddressController::class,'defaultAddress']);
    Route::post('/',[AddressController::class,'store']);
    Route::delete('/',[AddressController::class,'destroy']);
});
