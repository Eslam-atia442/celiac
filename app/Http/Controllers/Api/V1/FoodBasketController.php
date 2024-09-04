<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\BaseApiController;
use App\Http\Requests\api\FoodBasketRequestRequest;
use App\Http\Resources\FoodBasketRequestResource;
use App\Services\FoodBasketRequestService;

/**
 * @group Api
 * @subgroup food basket request
 */
class FoodBasketController extends BaseApiController
{

    /**
     *  FoodBasketRequest constructor.
     * @param FoodBasketRequestService $service
     */
    public array $relations;

    public function __construct(FoodBasketRequestService $service)
    {
        $this->service = $service;
        parent::__construct($service, FoodBasketRequestResource::class);

    }



    /**
     * Create FoodBasketRequest
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
    public function store(FoodBasketRequestRequest $request): mixed
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
