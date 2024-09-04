<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\ClinicRequest;
use App\Http\Resources\ClinicResource;
use App\Models\Clinic;
use App\Services\ClinicService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
 * @subgroup Specialty
 */

class ClinicController extends BaseApiController
{
     /**
        * SpecialtyController constructor.
        * @param ClinicService $service
        */


       public function __construct(ClinicService $service)
       {
           $this->service = $service;
           parent::__construct($service, ClinicResource::class);
       }

    /**
     * Store a newly created resource in storage.
     * @param ClinicRequest $request
     * @return JsonResponse
     */
    public function store(ClinicRequest $request): JsonResponse
    {
        try {
            $specialty = $this->service->create($request->validated());
            return $this->respondWithModel($specialty->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
   /**
    * Display the specified resource.
    * @param Clinic $specialty
    * @return JsonResponse
    */
   public function show(Clinic $specialty): JsonResponse
   {
       try {
           return $this->respondWithModel($specialty->load($this->relations));
       }catch (Exception $e) {
           return $this->respondWithError($e->getMessage());
       }
   }
    /**
     * Update the specified resource in storage.
     *
     * @param ClinicRequest $request
     * @param Clinic $specialty
     * @return JsonResponse
     */
    public function update(ClinicRequest $request, Clinic $specialty) : JsonResponse
    {
        try {
            $specialty = $this->service->update($specialty, $request->validated());
            return $this->respondWithModel($specialty->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     * @param Clinic $specialty
     * @return JsonResponse
     */
    public function destroy(Clinic $specialty): JsonResponse
    {
        try {
            $this->service->remove($specialty);
            return $this->respondWithSuccess(__('messages.deleted'));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * active & inactive the specified resource from storage.
     * @param Clinic $specialty
     * @return JsonResponse
     */
    public function changeActivation(Clinic $specialty): JsonResponse
    {
        try {
            $this->service->toggleField($specialty, 'is_active');
            return $this->respondWithModel($specialty->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
