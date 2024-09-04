<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\MedicalCenterRequest;
use App\Http\Resources\MedicalCenterResource;
use App\Models\MedicalCenter;
use App\Services\MedicalCenterService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Api
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
           $this->relations = ['image','pdf'];
           parent::__construct($service, MedicalCenterResource::class);
       }
    /**
     * MedicalCenters List
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"",
     *      "description" :"",
     *      "date" :""
     *      "image" :""
     *  }
     * }
     */
    public function index(): mixed
    {
        $models = $this->service->search([], $this->relations);
        return $this->respondWithCollection($models);
    }
}
