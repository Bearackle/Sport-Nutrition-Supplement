<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ComboController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductVariantController;
use App\Http\Controllers\Api\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix' => 'account'
],function(){
    Route::post('login',[UserController::class,'login']);
    Route::post('register',[UserController::class,'register']);
    Route::get('profile',[UserController::class,'show'])->middleware('auth:sanctum');
    Route::patch('change-password',[UserController::class,'update'])->middleware('auth:sanctum');
});
Route::group([
    'prefix' => 'collection'
],function(){
    Route::get('all',[ProductController::class,'filter']);
    Route::get('category/{id}',[ProductController::class,'CategoryProduct']);
    Route::get('products', [ProductController::class,'filter']);
    Route::get('search',[ProductController::class,'search']);
});
Route::group([
    'prefix' => 'products'
],function(){
    Route::get('top-deals' , [ProductController::class,'index']);
    Route::post('create', [ProductController::class,'store'])->middleware('auth:sanctum');
    Route::get('/{id}',[ProductController::class,'show']);
    Route::get('admin/{id}',[ProductController::class,'showProductsAdmin'])->middleware('auth:sanctum');
    Route::delete('/{id}',[ProductController::class,'destroy'])->middleware('auth:sanctum');
    Route::patch('/{id}',[ProductController::class,'update'])->middleware('auth:sanctum');
    //image product
    Route::post('/{id}/image',[ProductController::class,'uploadImage'])->middleware('auth:sanctum');
    Route::post('/image/{id}',[ProductController::class,'updateImage'])->middleware('auth:sanctum');
    Route::delete('/image/{image_id}',[ProductController::class,'destroyImage'])->middleware('auth:sanctum');
    // variants
    Route::get('/{id}/variants',[ProductVariantController::class,'VariantsOfProduct']);
    Route::get('admin/{id}/variants',[ProductVariantController::class,'VariantsOfProductAdmin'])->middleware('auth:sanctum');
});
//variant management
Route::group([
    'prefix' => 'products/variants'], function() {
    Route::post('/', [ProductVariantController::class,'store'])->middleware('auth:sanctum');
    Route::patch('/{id}', [ProductVariantController::class, 'update'])->middleware('auth:sanctum');
    Route::post('/image/{image_id}', [ProductVariantController::class, 'updateImage'])->middleware('auth:sanctum');
    Route::delete('/{id}', [ProductVariantController::class, 'destroy'])->middleware('auth:sanctum');
});
Route::group([
    'prefix' => 'description-image'
],function (){
    Route::post('/', [ProductController::class, 'uploadDescriptionImage'])->middleware('auth:sanctum');
    Route::get('/', [ProductController::class, 'getAllDescriptionImages'])->middleware('auth:sanctum');
    Route::delete('/{id}',[ProductController::class, 'destroyDescriptionImage'])->middleware('auth:sanctum');
})->middleware('auth:sanctum');
Route::group([
    'prefix' => 'categories'
],function(){
    Route::get('/',[CategoryController::class,'index']);
    Route::get('/top-products',[CategoryController::class,'getTopProductCategories']);
    Route::get('/{id}/children',[CategoryController::class,'ChildrenCategories']);
});
Route::group([
    'prefix' => 'brands'
],function (){
    Route::get('/all',[BrandController::class,'index']);
});
Route::group([
    'prefix' => 'combo'
],function(){
    Route::get('/all',[ComboController::class,'index']);
    Route::get('/{id}',[ComboController::class,'show']);
    Route::post('create',[ComboController::class,'store'])->middleware('auth:sanctum');
    Route::post('add',[ComboController::class,'add'])->middleware('auth:sanctum');
    Route::delete('/{id}',[ComboController::class,'destroy'])->middleware('auth:sanctum');
});
Route::group([
    'prefix' => 'cart'],
    function() {
        Route::get('all', [CartController::class, 'show'])->middleware('auth:sanctum');
        Route::get('/', [CartController::class, 'index'])->middleware('auth:sanctum');
        Route::post('new', [CartController::class, 'newCart'])->middleware('auth:sanctum');
        Route::post('item',[CartController::class,'store'])->middleware('auth:sanctum');;
        Route::delete('item/{id}',[CartController::class,'destroy'])->middleware('auth:sanctum');
        Route::patch('item/{id}',[CartController::class,'update'])->middleware('auth:sanctum');
    });
Route::group([
    'prefix' => 'order'],function(){
    Route::get('all',[OrderController::class,'index'])->middleware('auth:sanctum');
    Route::get('admin/all',[OrderController::class, 'adminGetOrders'])->middleware('auth:sanctum');
    Route::get('/{order_id}',[OrderController::class,'show'])->middleware('auth:sanctum');
    Route::post('create',[OrderController::class,'store'])->middleware('auth:sanctum');
    Route::patch('status/{id}',[OrderController::class,'update'])->middleware('auth:sanctum');
    Route::delete('/{id}',[OrderController::class,'destroy'] )->middleware('auth:sanctum');
    Route::get('payment/{id}',[OrderController::class,'getOrderPayments'])->middleware('auth:sanctum');
    Route::post('payment',[OrderController::class,'addPayment'])->middleware('auth:sanctum');
    Route::post('address',[OrderController::class,'addAddress'])->middleware('auth:sanctum');
    Route::post('ship', [OrderController::class,'addShipping'])->middleware('auth:sanctum');
});

Route::group([
    'prefix' => 'address'
], function(){
    Route::get('/',[AddressController::class,'show'])->middleware('auth:sanctum');
    Route::get('default',[AddressController::class,'defaultAddress'])->middleware('auth:sanctum');
    Route::post('/',[AddressController::class,'store'])->middleware('auth:sanctum');
    Route::delete('/{id}',[AddressController::class,'destroy'])->middleware('auth:sanctum');
});
Route::group([
    'prefix' => 'payment'
], function(){
    Route::get('/check-out', [PaymentController::class, 'create'])->middleware('auth:sanctum');
});
Route::group([
    'prefix' => 'review'
], function(){
    Route::get('/product/{id}', [ReviewController::class,'showProductReview']);
    Route::get('/combo/{id}', [ReviewController::class,'showComboReview']);
    Route::post('/',[ReviewController::class,'store'])->middleware('auth:sanctum');
    Route::post('image',[ReviewController::class,'addImage'])->middleware('auth:sanctum');
    Route::patch('/{id}',[ReviewController::class,'update'])->middleware('auth:sanctum');
    Route::delete('/{id}',[ReviewController::class,'destroy'])->middleware('auth:sanctum');
    Route::delete('image/{id}',[ReviewController::class,'destroyImage'])->middleware('auth:sanctum');
});
