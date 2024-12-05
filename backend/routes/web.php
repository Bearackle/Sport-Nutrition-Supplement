<?php

use App\Http\Controllers\Api\PaymentController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-email', function(){
});
Route::get('payment/check-out/{id}',[PaymentController::class,'checkOut']);
Route::post('payment/vn-pay',[PaymentController::class,'vnpayPayment']);
Route::post('payment/momo-pay',[PaymentController::class,'momoPayment']);
Route::post('payment/internet-banking',[PaymentController::class,'internetBanking']);
Route::post('payment/cod',[PaymentController::class,'codPayment']);

