<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\Product\CategoryServiceInterface;

class CategoryController
{
    protected CategoryServiceInterface $categoryService;
    public function __construct (CategoryServiceInterface $categoryService){
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->categoryService->getCategoryTrace();
    }
    public function getTopProductsByCategory(){
        return $this->categoryService->getTopProductCategories();
    }
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
