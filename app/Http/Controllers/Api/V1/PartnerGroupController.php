<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\PartnerGroupService;
use App\Http\Controllers\BaseApiController;
use App\Http\Resources\PartnerGroupResource;

/**
 * @group Api
 * @subgroup Partner
 */

class PartnerGroupController extends BaseApiController
{
       public function __construct(PartnerGroupService $service)
       {
           $this->service = $service;
           $this->relations = ['partners'];
           parent::__construct($service, PartnerGroupResource::class);
       }

    /**
     * partner grouped
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"الشريك الرسمي"
     *  }
     * }
     */
    public function index(): mixed
    {
        request()->merge(['page' => false, 'limit'=> false]);
        $models = $this->service->search([], $this->relations);
        return $this->respondWithCollection($models);
    }


}
