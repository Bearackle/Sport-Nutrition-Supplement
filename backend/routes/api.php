<?php

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
    Route::get('all',[ProductController::class,'index']);

});

Route::group([
    'prefix' => 'categories'
],function(){
    Route::get('all',[CategoryController::class,'index']);
});

