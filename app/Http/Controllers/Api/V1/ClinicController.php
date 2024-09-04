<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\BooleanEnum;
use App\Enums\FileEnum;
use App\Enums\HealthLibraryTypeEnum;
use App\Http\Controllers\BaseApiController;
use App\Http\Resources\ClinicResource;
use App\Http\Resources\HealthLibraryResource;
use App\Services\ClinicService;
use App\Services\HealthLibraryService;

/**
 * @group Api
 * @subgroup Clinic
 */
class ClinicController extends BaseApiController
{

    /**
     *  Clinic constructor.
     * @param ClinicService $service
     */
    public array $relations = [];

    public function __construct(ClinicService $service)
    {
        $this->service = $service;
        parent::__construct($service, ClinicResource::class);

    }

    /**
     * List
     *
     * @queryParam filters[keyword] Filter by name , location
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
        \request()->merge(['page' => false, 'limit' => false,'scope'=>'full']);
        $models = $this->service->search([], $this->relations);
        return $this->respondWithCollection($models);
    }

    /**
     * clinic details
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
    public function show($id)
    {
        $model = $this->service->find($id, ['calendarDays'] );
        return $this->respondWithModel($model);

    }
}
