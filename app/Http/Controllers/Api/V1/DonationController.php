<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\DonationService;
use App\Http\Resources\DonationResource;
use App\Http\Controllers\BaseApiController;

/**
 * @group Api
 * @subgroup Donation
 */

class DonationController extends BaseApiController
{
     /**
        * DonationController constructor.
        * @param DonationService $service
        */


       public function __construct(DonationService $service)
       {
           $this->service = $service;
           $this->relations = ['image'];
           parent::__construct($service, DonationResource::class);
       }

    /**
     * Donations List
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"تبرع عام",
     *      "image":'',
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
