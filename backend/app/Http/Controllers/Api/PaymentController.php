<?php

namespace App\Http\Controllers\Api;

use App\DTOs\InputData\OrderInputData;
use App\DTOs\OutputData\OrderOutputData;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Services\Order\PaymentService;
use App\Services\Order\PaymentServiceInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected PaymentServiceInterface $paymentService;
    public function __construct(PaymentServiceInterface $paymentService){
        $this->paymentService = $paymentService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = OrderInputData::validateAndCreate(['order_id' => $request->get('orderId')]);
        $this->paymentService->createPayment($order,$request->ip());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
