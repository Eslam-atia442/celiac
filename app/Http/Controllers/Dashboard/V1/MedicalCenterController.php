<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\MedicalCenterRequest;
use App\Http\Resources\MedicalCenterResource;
use App\Models\MedicalCenter;
use App\Services\MedicalCenterService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
 * @subgroup MedicalCenter
 */

class MedicalCenterController extends BaseApiController
{
     /**
        * MedicalCenterController constructor.
        * @param MedicalCenterService $service
        */


       public function __construct(MedicalCenterService $service)
       {
           $this->service = $service;
           $this->relations = ['image', 'pdf'];
           parent::__construct($service, MedicalCenterResource::class);
       }

    /**
     * Store a newly created resource in storage.
     * @param MedicalCenterRequest $request
     * @return JsonResponse
     */
    public function store(MedicalCenterRequest $request): JsonResponse
    {
        try {
            $medicalCenter = $this->service->create($request->validated());
            return $this->respondWithModel($medicalCenter->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
   /**
    * Display the specified resource.
    * @param MedicalCenter $medicalCenter
    * @return JsonResponse
    */
   public function show(MedicalCenter $medicalCenter): JsonResponse
   {
       try {
           return $this->respondWithModel($medicalCenter->load($this->relations));
       }catch (Exception $e) {
           return $this->respondWithError($e->getMessage());
       }
   }
    /**
     * Update the specified resource in storage.
     *
     * @param MedicalCenterRequest $request
     * @param MedicalCenter $medicalCenter
     * @return JsonResponse
     */
    public function update(MedicalCenterRequest $request, MedicalCenter $medicalCenter) : JsonResponse
    {
        try {
            $medicalCenter = $this->service->update($medicalCenter, $request->validated());
            return $this->respondWithModel($medicalCenter->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     * @param MedicalCenter $medicalCenter
     * @return JsonResponse
     */
    public function destroy(MedicalCenter $medicalCenter): JsonResponse
    {
        try {
            $this->service->remove($medicalCenter);
            return $this->respondWithSuccess(__('messages.deleted'));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * active & inactive the specified resource from storage.
     * @param MedicalCenter $medicalCenter
     * @return JsonResponse
     */
    public function changeActivation(MedicalCenter $medicalCenter): JsonResponse
    {
        try {
            $this->service->toggleField($medicalCenter, 'is_active');
            return $this->respondWithModel($medicalCenter->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
