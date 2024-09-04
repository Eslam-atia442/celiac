<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\PartnerGroupRequest;
use App\Http\Resources\PartnerGroupResource;
use App\Models\PartnerGroup;
use App\Services\PartnerGroupService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
 * @subgroup PartnerGroup
 */
class PartnerGroupController extends BaseApiController
{
    /**
     * PartnerGroupController constructor.
     * @param PartnerGroupService $service
     */


    public function __construct(PartnerGroupService $service)
    {
        $this->relations = ['partners'];
        $this->service = $service;
        parent::__construct($service, PartnerGroupResource::class, 'partner-group');
    }

    /**
     * Store a newly created resource in storage.
     * @param PartnerGroupRequest $request
     * @return JsonResponse
     */
    public function store(PartnerGroupRequest $request): JsonResponse
    {
        try {
            $partnerGroup = $this->service->create($request->validated());
            return $this->respondWithModel($partnerGroup->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     * @param PartnerGroup $partnerGroup
     * @return JsonResponse
     */
    public function show(PartnerGroup $partnerGroup): JsonResponse
    {
        try {
            return $this->respondWithModel($partnerGroup->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PartnerGroupRequest $request
     * @param PartnerGroup $partnerGroup
     * @return JsonResponse
     */
    public function update(PartnerGroupRequest $request, PartnerGroup $partnerGroup): JsonResponse
    {
        try {
            $partnerGroup = $this->service->update($partnerGroup, $request->validated());
            return $this->respondWithModel($partnerGroup->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param PartnerGroup $partnerGroup
     * @return JsonResponse
     */
    public function destroy(PartnerGroup $partnerGroup): JsonResponse
    {
        try {
            $this->service->remove($partnerGroup);
            return $this->respondWithSuccess(__('messages.deleted'));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * active & inactive the specified resource from storage.
     * @param PartnerGroup $partnerGroup
     * @return JsonResponse
     */
    public function changeActivation(PartnerGroup $partnerGroup): JsonResponse
    {
        try {
            $this->service->toggleField($partnerGroup, 'is_active');
            return $this->respondWithModel($partnerGroup->load($this->relations));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
