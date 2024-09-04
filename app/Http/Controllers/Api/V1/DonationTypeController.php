<?php

namespace App\Http\Controllers\Api\V1;


use App\Services\DonationTypeService;
use App\Http\Controllers\BaseApiController;
use App\Http\Resources\DonationTypeResource;

/**
 * @group Api
 * @subgroup Donation
 */

class DonationTypeController extends BaseApiController
{
     /**
        * DonationTypeController constructor.
        * @param DonationTypeService $service
        */


       public function __construct(DonationTypeService $service)
       {
           $this->service = $service;
           parent::__construct($service, DonationTypeResource::class);
       }
    /**
     * Donation Types List
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"تبرع",
     *      "image":"",
     *      "image":"",
     *  }
     * }
     */

    public function index(): mixed
    {
        request()->merge(['page' => false, 'limit'=> false]);
        $models = $this->service->search(['active'], $this->relations);
        return $this->respondWithCollection($models);
    }


}
