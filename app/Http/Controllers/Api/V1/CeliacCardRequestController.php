<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\BaseApiController;
use App\Http\Requests\api\CeliacCardRequest;
use App\Http\Resources\ClinicResource;
use App\Http\Resources\CeliacCardResource;
use App\Models\Rate;
use App\Models\CeliacCard;
use App\Services\ClinicService;
use App\Services\CeliacCardService;
use Exception;
use Illuminate\Http\Client\Request;
use Illuminate\Http\JsonResponse;

/**
 * @group Api
 * @subgroup Celiac Card
 */
class CeliacCardRequestController extends BaseApiController
{

    /**
     *  CeliacCard constructor.
     * @param CeliacCardService $service
     */
    public array $relations;

    public function __construct(CeliacCardService $service)
    {
        $this->service = $service;
        $this->relations = ['medicalReport'];
        parent::__construct($service, CeliacCardResource::class);

    }

    //@queryParam filters[keyword] Filter by name , location

    /**
     * My CeliacCard
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
    public function getCeliacCard()
    {
        $response = $this->service->getMyCeliacCard();
        if ($response)
        {
            return $this->respondWithModel($response);
        }
        return $this->respondWithError('you have not celiac card');

    }


    /**
     * Create CeliacCard
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
    public function store(CeliacCardRequest $request): mixed
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
