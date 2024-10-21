<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartIdRequest;
use App\Http\Requests\NewCartItems;
use App\Http\Responses\ApiResponse;
use App\Services\Order\CartServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use mysql_xdevapi\Collection;

class CartController extends Controller
{
    protected CartServiceInterface $cartService;
    public function __construct(CartServiceInterface $cartService)
    {
        $this->cartService = $cartService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        return $this->cartService->getCart($id);
    }
    public function newCart(Request $request): ApiResponse
    {
        $request->validate([
            'UserID' => 'required|exists:users,userid'
        ],['UserID.exists' => 'User not found']);
        $this->cartService->createCart($request->get('UserID'));
        return ApiResponse::success('created successful');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(NewCartItems $request) : ApiResponse
    {
        $this->cartService->addCartItem($request->validated());
        return ApiResponse::success('create successful');
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $request->validate([
            'cartid' => 'required|exists:Shopping_carts,CartID',]);
        return $this->cartService->getItems($request->get('cartid'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(CartIdRequest $request) : ApiResponse
    {
        $request->validate([
            'Quantity' => 'required|numeric']);
        $this->cartService->updateCartItemQuantity($request->all());
        return ApiResponse::success('update successful');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartIdRequest $request) : ApiResponse
    {
        $this->cartService->deleteCartItem($request->all());
        return ApiResponse::success('deleted successfully');
    }
}
