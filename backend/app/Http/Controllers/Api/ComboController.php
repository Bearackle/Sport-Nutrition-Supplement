<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComboRequest;
use App\Http\Requests\NewProductCombo;
use App\Http\Requests\NewProductRequest;
use App\Http\Resources\ComboResource;
use App\Repositories\Combo\ComboRepository;
use App\Services\Combo\ComboServiceInterface;
use Illuminate\Http\Request;

class ComboController extends Controller
{
    protected ComboServiceInterface $comboService;
    public function __construct(ComboServiceInterface $comboService){
        $this->comboService = $comboService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): ComboResource
    {
        return new ComboResource($this->comboService->getAllCombos());
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(ComboRequest $request) :void
    {
        $data_to_trans = $request->validated();
        $this->comboService->createCombo($data_to_trans,$request->file("Image"));
    }
    public function add(NewProductCombo $request) : void{
        $this->comboService->addProductCombo($request->validated());
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       return $this->comboService->getComboById($id);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : void
    {
        $this->comboService->destroyCombo($id);
    }
}
