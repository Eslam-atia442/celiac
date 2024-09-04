<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\DonationTypeRequest;
use App\Http\Resources\DonationTypeResource;
use App\Models\DonationType;
use App\Services\DonationTypeService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
 * @subgroup DonationType
 */
class DonationTypeController extends BaseApiController
{
    /**
     * DonationTypeController constructor.
     * @param  DonationTypeService  $service
     */

    public function __construct(DonationTypeService $service)
    {
        $this->service = $service;
        parent::__construct($service, DonationTypeResource::class, 'donation-type');
    }

    /**
     * Store a newly created resource in storage.
     * @param  DonationTypeRequest  $request
     * @return JsonResponse
     */
    public function store(DonationTypeRequest $request): JsonResponse
    {
        try {
            $donationType = $this->service->create($request->validated());
            return $this->respondWithModel($donationType->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     * @param  DonationType  $donationType
     * @return JsonResponse
     */
    public function show(DonationType $donationType): JsonResponse
    {
        try {
            return $this->respondWithModel($donationType->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  DonationTypeRequest  $request
     * @param  DonationType  $donationType
     * @return JsonResponse
     */
    public function update(DonationTypeRequest $request, DonationType $donationType): JsonResponse
    {
        try {
            $donationType = $this->service->update($donationType, $request->validated());
            return $this->respondWithModel($donationType->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  DonationType  $donationType
     * @return JsonResponse
     */
    public function destroy(DonationType $donationType): JsonResponse
    {
        try {
            $this->service->remove($donationType);
            return $this->respondWithSuccess(__('messages.deleted'));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * active & inactive the specified resource from storage.
     * @param  DonationType  $donationType
     * @return JsonResponse
     */
    public function changeActivation(DonationType $donationType): JsonResponse
    {
        try {
            $this->service->toggleField($donationType, 'is_active');
            return $this->respondWithModel($donationType->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
