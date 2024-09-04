<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\RateRequest;
use App\Http\Resources\RateResource;
use App\Models\Rate;
use App\Services\RateService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
 * @subgroup Rate
 */

class RateController extends BaseApiController
{
     /**
        * RateController constructor.
        * @param RateService $service
        */


       public function __construct(RateService $service)
       {
           $this->service = $service;
           parent::__construct($service, RateResource::class);
       }

    /**
     * Store a newly created resource in storage.
     * @param RateRequest $request
     * @return JsonResponse
     */
    public function store(RateRequest $request): JsonResponse
    {
        try {
            $rate = $this->service->create($request->validated());
            return $this->respondWithModel($rate->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
   /**
    * Display the specified resource.
    * @param Rate $rate
    * @return JsonResponse
    */
   public function show(Rate $rate): JsonResponse
   {
       try {
           return $this->respondWithModel($rate->load($this->relations));
       }catch (Exception $e) {
           return $this->respondWithError($e->getMessage());
       }
   }
    /**
     * Update the specified resource in storage.
     *
     * @param RateRequest $request
     * @param Rate $rate
     * @return JsonResponse
     */
    public function update(RateRequest $request, Rate $rate) : JsonResponse
    {
        try {
            $rate = $this->service->update($rate, $request->validated());
            return $this->respondWithModel($rate->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     * @param Rate $rate
     * @return JsonResponse
     */
    public function destroy(Rate $rate): JsonResponse
    {
        try {
            $this->service->remove($rate);
            return $this->respondWithSuccess(__('messages.deleted'));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * active & inactive the specified resource from storage.
     * @param Rate $rate
     * @return JsonResponse
     */
    public function changeActivation(Rate $rate): JsonResponse
    {
        try {
            $this->service->toggleField($rate, 'is_active');
            return $this->respondWithModel($rate->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
