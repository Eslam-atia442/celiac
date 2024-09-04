<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Resources\MedicalConsultingResource;
use App\Services\MedicalConsultingService;

/**
 * @group Dashboard
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
     * Lists
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"eman mahmoud",
     *      "email" :"ahlamelhna@gmail.com",
     *  }
     * }
     */
    public function index(): mixed
    {
        return parent::index();
    }

}
