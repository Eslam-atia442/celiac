<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\GovernanceListService;
use App\Http\Controllers\BaseApiController;
use App\Http\Resources\GovernanceListResource;
/**
 * @group Api
 * @subgroup Governance List
 */

class GovernanceController extends BaseApiController
{
     public function __construct(GovernanceListService $service)
     {
           $this->service = $service;
           $this->relations = ['activeFiles'];
           parent::__construct($service, GovernanceListResource::class);
     }

    /**
     * Governance List
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"القوائم المالية",
     *      "attachments":[],
     *  }
     * }
     */
    public function index(): mixed
    {
        request()->merge(['page' => false, 'limit'=> false, 'withActiveFileCount'=> true]);
        $models = $this->service->search([], $this->relations);
        return $this->respondWithCollection($models);
    }
}
