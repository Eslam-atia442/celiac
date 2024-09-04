<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\BannerService;
use App\Http\Resources\BannerResource;
use App\Http\Controllers\BaseApiController;

/**
 * @group Api
 * @subgroup Banner
 */

class BannerController extends BaseApiController
{
     /**
      * BannerController constructor.
      * @param BannerService $service
     */
       public function __construct(BannerService $service)
       {
           $this->service = $service;
           $this->relations = ['image'];
           parent::__construct($service, BannerResource::class);
       }
    /**
     * Banners List
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"سلايدر",
     *      "description":"",
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
