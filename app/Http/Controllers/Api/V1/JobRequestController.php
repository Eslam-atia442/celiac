<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\BaseApiController;
use App\Http\Requests\api\JobRequestRequest;
use App\Http\Resources\JobRequestResource;
use App\Services\JobRequestService;

/**
 * @group Api
 * @subgroup job request ( hiring )
 */
class JobRequestController extends BaseApiController
{

    /**
     *  JobRequest constructor.
     * @param JobRequestService $service
     */
    public array $relations;

    public function __construct(JobRequestService $service)
    {
        $this->service = $service;
        $this->relations = ['cv'];
        parent::__construct($service, JobRequestResource::class);

    }



    /**
     * Create JobRequest
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
    public function store(JobRequestRequest $request): mixed
    {
        \request()->merge(['scope' => 'full']);
        $data = $request->validated();
        $response = $this->service->create($data);
        
        if (@$response['status'] == 400) {
            return $this->respondWithError($response['message']);
        }

        return $this->respondWithModel($response);
    }

}
