<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Services\Product\BrandServcieInterface;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected BrandServcieInterface $brandServcie;
    public function __construct(BrandServcieInterface $brandServcie){
        $this->brandServcie = $brandServcie;
    }
    /**
     * @OA\Get(
     *     path="/api/brands/all",
     *     tags={"Brand"},
     *     summary="Tất cả nhãn hiệu",
     *     description="Lấy tất cả nhãn hiệu",
     *   @OA\Response(response=200, description="Lấy thành công",@OA\JsonContent()),
     *   @OA\Response(response=400, description="Lấy thất bại",@OA\JsonContent())
     * )
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return BrandResource::collection($this->brandServcie->getBrands());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
