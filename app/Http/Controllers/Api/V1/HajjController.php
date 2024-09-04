<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\BaseApiController;
use App\Http\Requests\api\HajjRequestRequest;
use App\Http\Resources\HajjRequestResource;
use App\Services\HajjRequestService;

/**
 * @group Api
 * @subgroup food basket request
 */
class HajjController extends BaseApiController
{

    /**
     *  HajjRequest constructor.
     * @param HajjRequestService $service
     */
    public array $relations;

    public function __construct(HajjRequestService $service)
    {
        $this->service = $service;
        $this->relations = ['file'];
        parent::__construct($service, HajjRequestResource::class);

    }



    /**
     * Create Hajj Request
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
    public function store(HajjRequestRequest $request): mixed
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
