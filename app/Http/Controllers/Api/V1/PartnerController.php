<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\PartnerService;
use App\Http\Resources\PartnerResource;
use App\Http\Controllers\BaseApiController;

/**
 * @group Api
 * @subgroup Partner
 */

class PartnerController extends BaseApiController
{
       /**
        * PartnerController constructor.
        * @param PartnerService $service
        */
       public function __construct(PartnerService $service)
       {
           $this->service = $service;
           $this->relations = ['image', 'partnerGroup'];
           parent::__construct($service, PartnerResource::class);
       }

    /**
     * Partners
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :""
     *      "image" :"",
     *      "partnerGroup" :"",
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
