<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Services\PositionService;
use App\Http\Resources\PositionResource;
use App\Http\Controllers\BaseApiController;
/**
 * @group Dashboard
 * @subgroup Positions
 */

class PositionController extends BaseApiController
{
     /**
        * PositionController constructor.
        * @param PositionService $service
        */


       public function __construct(PositionService $service)
       {
           $this->service = $service;
           parent::__construct($service, PositionResource::class, 'position');
       }

    /**
     * Lists
     *
     * @queryParam filters[keyword] Filter by name.
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"",
     *  }
     * }
     */
}
