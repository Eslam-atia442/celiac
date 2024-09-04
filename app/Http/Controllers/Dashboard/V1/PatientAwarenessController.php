<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Enums\FileEnum;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\PatientAwarenessRequest;
use App\Http\Resources\PatientAwarenessResource;
use App\Models\PatientAwareness;
use App\Services\PatientAwarenessService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
 * @subgroup PatientAwareness
 */

class PatientAwarenessController extends BaseApiController
{
     /**
        * PatientAwarenessController constructor.
        * @param PatientAwarenessService $service
        */


       public function __construct(PatientAwarenessService $service)
       {
           $this->service = $service;
           $this->relations = ['image', 'pdf'];
           $this->type_image = FileEnum::file_type_patient_awareness_image->value;
           $this->type_pdf = FileEnum::file_type_patient_awareness_pdf->value;
           $this->path = config('filesystems.upload.paths.scientific_researches');
           parent::__construct($service, PatientAwarenessResource::class);
       }

    /**
     * Store a newly created resource in storage.
     * @param PatientAwarenessRequest $request
     * @return JsonResponse
     */
    public function store(PatientAwarenessRequest $request): JsonResponse
    {
        try {
            $patientAwareness = $this->service->createPatientAwareness($request->validated(), $this->type_image, $this->type_pdf, $this->path);
            return $this->respondWithModel($patientAwareness->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
   /**
    * Display the specified resource.
    * @param PatientAwareness $patientAwareness
    * @return JsonResponse
    */
   public function show(PatientAwareness $patientAwareness): JsonResponse
   {

       try {
           return $this->respondWithModel($patientAwareness->load($this->relations));
       }catch (Exception $e) {
           return $this->respondWithError($e->getMessage());
       }
   }
    /**
     * Update the specified resource in storage.
     *
     * @param PatientAwarenessRequest $request
     * @param PatientAwareness $patientAwareness
     * @return JsonResponse
     */
    public function update(PatientAwarenessRequest $request, PatientAwareness $patientAwareness) : JsonResponse
    {
        try {
            $patientAwareness = $this->service->updatePatientAwareness($patientAwareness, $request->validated() , $this->type_image, $this->type_pdf, $this->path);
            return $this->respondWithModel($patientAwareness->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     * @param PatientAwareness $patientAwareness
     * @return JsonResponse
     */
    public function destroy(PatientAwareness $patientAwareness): JsonResponse
    {
        try {
            $this->service->remove($patientAwareness);
            return $this->respondWithSuccess(__('messages.deleted'));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * active & inactive the specified resource from storage.
     * @param PatientAwareness $patientAwareness
     * @return JsonResponse
     */
    public function changeActivation(PatientAwareness $patientAwareness): JsonResponse
    {
        try {
            $this->service->toggleField($patientAwareness, 'is_active');
            return $this->respondWithModel($patientAwareness->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
