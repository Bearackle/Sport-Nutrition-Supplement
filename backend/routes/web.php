<?php

use App\Http\Controllers\Api\PaymentController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-email', function(){
});
Route::get('payment/check-out', function(){
    return view('ConfirmPayment');
});
Route::post('payment/vn-pay',[PaymentController::class,'vnpayPayment']);

