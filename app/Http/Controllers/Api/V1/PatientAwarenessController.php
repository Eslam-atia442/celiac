<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Resources\PatientAwarenessResource;
use App\Services\PatientAwarenessService;

/**
 * @group Api
 * @subgroup  Patient Awareness
 */
class PatientAwarenessController extends BaseApiController
{

    /**
     *  Patient Awareness constructor.
     * @param PatientAwarenessService $service
     */
    public array $relations;

    public function __construct(PatientAwarenessService $service )
    {
        $this->service = $service;
        $this->relations = ['image', 'pdf'];
        parent::__construct($service, PatientAwarenessResource::class);

    }

    /**
     * List
     *
     *
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *   }
     * }
     *
     */
    public function index(): mixed
    {
         $models = $this->service->search([], $this->relations);
        return $this->respondWithCollection($models);
    }
}
