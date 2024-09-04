<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use App\Services\ReviewService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
 * @subgroup Review
 */

class ReviewController extends BaseApiController
{
     /**
        * ReviewController constructor.
        * @param ReviewService $service
        */


       public function __construct(ReviewService $service)
       {
           $this->service = $service;
           parent::__construct($service, ReviewResource::class);
       }

    /**
     * Store a newly created resource in storage.
     * @param ReviewRequest $request
     * @return JsonResponse
     */
    public function store(ReviewRequest $request): JsonResponse
    {
        try {
            $review = $this->service->create($request->validated());
            return $this->respondWithModel($review->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
   /**
    * Display the specified resource.
    * @param Review $review
    * @return JsonResponse
    */
   public function show(Review $review): JsonResponse
   {
       try {
           return $this->respondWithModel($review->load($this->relations));
       }catch (Exception $e) {
           return $this->respondWithError($e->getMessage());
       }
   }
    /**
     * Update the specified resource in storage.
     *
     * @param ReviewRequest $request
     * @param Review $review
     * @return JsonResponse
     */
    public function update(ReviewRequest $request, Review $review) : JsonResponse
    {
        try {
            $review = $this->service->update($review, $request->validated());
            return $this->respondWithModel($review->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     * @param Review $review
     * @return JsonResponse
     */
    public function destroy(Review $review): JsonResponse
    {
        try {
            $this->service->remove($review);
            return $this->respondWithSuccess(__('messages.deleted'));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * active & inactive the specified resource from storage.
     * @param Review $review
     * @return JsonResponse
     */
    public function changeActivation(Review $review): JsonResponse
    {
        try {
            $this->service->toggleField($review, 'is_active');
            return $this->respondWithModel($review->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
