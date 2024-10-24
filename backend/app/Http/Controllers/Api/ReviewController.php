<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Review\ReviewServiceInterface;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected ReviewServiceInterface $review_service;
    public function __construct(ReviewServiceInterface $review_service){
        $this->review_service = $review_service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : void
    {
        $data = $request->input();
        $data['images'] = array_filter(array($request->file('images')));
        $this->review_service->addReview($data['UserID'], $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $data = $request->all();
        if(array_key_exists('ProductID',$data)){
            return $this->review_service->getReviewsOfProduct($data['ProductID']);
        }
        else{
            return $this->review_service->getReviewsOfCombo($data['ComboID']);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) : void
    {
        $this->review_service->updateReview($id, $request->input());
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $review_id) : void
    {
        $this->review_service->deleteReview($review_id);
    }
    public function addImage(Request $request) : void{
        $data = $this->review_service->getReviewData($request->input('ReviewID'))
            ->only(['ReviewID','ProductID','ComboID']);
        $data['images'] = array($request->file('images'));
        $this->review_service->addImagetoReview($data['ReviewID'], $data);
    }
    public function destroyImage(string $id) : void{
        $this->review_service->deleteImageOfReview($id);
    }
}
