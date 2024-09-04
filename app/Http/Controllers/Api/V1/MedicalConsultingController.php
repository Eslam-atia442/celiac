<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\MedicalConsultingRequest;
use App\Http\Resources\MedicalConsultingResource;
use App\Models\MedicalConsulting;
use App\Services\MedicalConsultingService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Api
 * @subgroup MedicalConsulting
 */

class MedicalConsultingController extends BaseApiController
{
     /**
        * MedicalConsultingController constructor.
        * @param MedicalConsultingService $service
        */


       public function __construct(MedicalConsultingService $service)
       {
           $this->service = $service;
           parent::__construct($service, MedicalConsultingResource::class);
       }
    /**
     * Send Consulting
     *
     * @bodyParam name string required
     * @bodyParam email string required
     * @bodyParam phone number required
     * @bodyParam country_code number required
     * @bodyParam birthdate string required
     * @bodyParam civil_id string required
     * @bodyParam gender string required
     * @bodyParam consulting string required
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name":"eman mahmoud",
     *      "phone":01011279823,
     *      "consulting":"test message",
     *  }
     * }
     */
    public function store(MedicalConsultingRequest $request): JsonResponse
    {
        try {
            $medicalConsulting = $this->service->create($request->validated());
            return $this->respondWithModel($medicalConsulting->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

}
