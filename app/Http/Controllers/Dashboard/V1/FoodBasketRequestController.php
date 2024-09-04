<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Enums\FoodBasketRequestStatusEnum;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\FoodBasketRequestRequest;
use App\Http\Resources\FoodBasketRequestResource;
use App\Models\FoodBasketRequest;
use App\Services\FoodBasketRequestService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
 * @subgroup FoodBasketRequest
 */

class FoodBasketRequestController extends BaseApiController
{
     /**
        * FoodBasketRequestController constructor.
        * @param FoodBasketRequestService $service
        */


       public function __construct(FoodBasketRequestService $service)
       {
           $this->service = $service;
           $this->relations = ['user'];
           parent::__construct($service, FoodBasketRequestResource::class);
       }



    /**
     * Display a listing of food basket requests
     *
     *
     */
    public function index(): mixed
    {
        request()->merge([ 'statusSearch' => FoodBasketRequestStatusEnum::pending->value ]);
        $models = $this->service->search([], $this->relations);
        return $this->respondWithCollection($models);
    }

    /**
     * Display a listing of food basket requests
     *
     *
     */

    public function acceptedJobs()
    {
        request()->merge([ 'statusSearch' => FoodBasketRequestStatusEnum::accepted->value ]);
        $models = $this->service->search([], $this->relations);
        return $this->respondWithCollection($models);
    }

    /**
     * Store a newly created resource in storage.
     * @param FoodBasketRequestRequest $request
     * @return JsonResponse
     */
    public function store(FoodBasketRequestRequest $request): JsonResponse
    {
        try {
            $foodBasketRequest = $this->service->create($request->validated());
            return $this->respondWithModel($foodBasketRequest->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
   /**
    * Display the specified resource.
    * @param FoodBasketRequest $foodBasketRequest
    * @return JsonResponse
    */
   public function show(FoodBasketRequest $foodBasketRequest): JsonResponse
   {
       try {
           return $this->respondWithModel($foodBasketRequest->load($this->relations));
       }catch (Exception $e) {
           return $this->respondWithError($e->getMessage());
       }
   }
    /**
     * Update the specified resource in storage.
     *
     * @param FoodBasketRequestRequest $request
     * @param FoodBasketRequest $foodBasketRequest
     * @return JsonResponse
     */
    public function update(FoodBasketRequestRequest $request, FoodBasketRequest $foodBasketRequest) : JsonResponse
    {
        try {
            $foodBasketRequest = $this->service->update($foodBasketRequest, $request->validated());
            return $this->respondWithModel($foodBasketRequest->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     * @param FoodBasketRequest $foodBasketRequest
     * @return JsonResponse
     */
    public function destroy(FoodBasketRequest $foodBasketRequest): JsonResponse
    {
        try {
            $this->service->remove($foodBasketRequest);
            return $this->respondWithSuccess(__('messages.deleted'));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * active & inactive the specified resource from storage.
     * @param FoodBasketRequest $foodBasketRequest
     * @return JsonResponse
     */
    public function changeActivation(FoodBasketRequest $foodBasketRequest): JsonResponse
    {
        try {
            $this->service->toggleField($foodBasketRequest, 'is_active');
            return $this->respondWithModel($foodBasketRequest->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
