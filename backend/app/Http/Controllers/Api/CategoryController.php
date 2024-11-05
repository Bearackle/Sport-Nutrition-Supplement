<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use App\Services\Product\CategoryServiceInterface;

class CategoryController
{
    protected CategoryServiceInterface $categoryService;
    public function __construct (CategoryServiceInterface $categoryService){
        $this->categoryService = $categoryService;
    }
    /**
     * @OA\Get(
     *     path="/api/categories/",
     *     summary="tìm cây category",
     *     tags={"Category"},
     *     description="trả về cây category gồm loại cha, loại con",
     *     @OA\Response(response=200,description="Thành công",
     *               @OA\JsonContent(
     *               type="object",
     *               @OA\Property(property="success", type="boolean", example=true),
     *               @OA\Property(property="message", type="string", example="Tìm cây category thành công")
     *           )),
     *     @OA\Response(response=400,description="Thất bại",
     *              @OA\JsonContent(
     *               type="object",
     *               @OA\Property(property="success", type="boolean", example=false),
     *               @OA\Property(property="message", type="string", example="Tạo sản phẩm thành công")
     *           )
     *        )
     *     )
     */
    public function index()
    {
        return CategoryResource::collection($this->categoryService->getCategoryTrace());
    }
    public function getTopProductsByCategory(){
        return $this->categoryService->getTopProductCategories();
    }

    /**
     * @OA\Get(
     *     path="/api/categories/{id}/children",
     *     summary="Lấy category con",
     *     description="Lấy category con của category có {id}",
     *     tags={"Category"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="id của category cha",
     *         @OA\Schema(type="integer")
     *          ),
     *     @OA\Response(response=200,description="Thành công")
     * )
     */
    public function ChildrenCategories($id){
        return $this->categoryService->getChildrenCategories($id);
    }
    public function show(string $id)
    {

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
