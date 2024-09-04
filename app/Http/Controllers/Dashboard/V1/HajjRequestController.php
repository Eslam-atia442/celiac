<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Enums\FoodBasketRequestStatusEnum;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\api\HajjRequestRequest;
use App\Http\Resources\HajjRequestResource;
use App\Models\HajjRequest;
use App\Services\HajjRequestService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Dashboard
 * @subgroup HajjRequest
 */
class HajjRequestController extends BaseApiController
{
    /**
     * HajjRequestController constructor.
     * @param HajjRequestService $service
     */


    public function __construct(HajjRequestService $service)
    {
        $this->service = $service;
        parent::__construct($service, HajjRequestResource::class);
    }


    /**
     * Display a listing of hajj requests
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
     * Display a listing of hajj requests
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
     * @param HajjRequestRequest $request
     * @return JsonResponse
     */
    public function store(HajjRequestRequest $request): JsonResponse
    {
        try {
            $hajjRequest = $this->service->create($request->validated());
            return $this->respondWithModel($hajjRequest->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     * @param HajjRequest $hajjRequest
     * @return JsonResponse
     */
    public function show(HajjRequest $hajjRequest): JsonResponse
    {
        try {
            return $this->respondWithModel($hajjRequest->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\api\HajjRequestRequest $request
     * @param HajjRequest $hajjRequest
     * @return JsonResponse
     */
    public function update(HajjRequestRequest $request, HajjRequest $hajjRequest): JsonResponse
    {
        try {
            $hajjRequest = $this->service->update($hajjRequest, $request->validated());
            return $this->respondWithModel($hajjRequest->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param HajjRequest $hajjRequest
     * @return JsonResponse
     */
    public function destroy(HajjRequest $hajjRequest): JsonResponse
    {
        try {
            $this->service->remove($hajjRequest);
            return $this->respondWithSuccess(__('messages.deleted'));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * active & inactive the apply for hajj.
     *
     *
     */
    public function changeSettings(Request $request): JsonResponse
    {
        try {
            $this->service->changeSettings();
            return $this->respondWithSuccess(__('messages.responses.updated'));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

}
