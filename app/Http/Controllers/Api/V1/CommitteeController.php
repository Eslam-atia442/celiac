<?php

namespace App\Http\Controllers\Api\V1;

use Exception;
use App\Models\Committee;
use Illuminate\Http\JsonResponse;
use App\Services\CommitteeService;
use App\Http\Resources\CommitteeResource;
use App\Http\Controllers\BaseApiController;

/**
 * @group Api
 * @subgroup Committee
 */

class CommitteeController extends BaseApiController
{
     public function __construct(CommitteeService $service)
     {
           $this->service = $service;
           $this->relations = ['members.image', 'mainIcon', 'icon'];
           parent::__construct($service, CommitteeResource::class);
     }

    /**
     * Committees
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"لجنة التدقيق والمراجعة الداخلية",
     *      "members":[],
     *  }
     * }
     */
    public function index(): mixed
    {
        request()->merge(['page' => false, 'limit'=> false, 'scope'=> 'mini']);
        $models = $this->service->search([], ['mainIcon', 'icon']);
        return $this->respondWithCollection($models);
    }


    /**
     * Committee Details
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"لجنة التدقيق والمراجعة الداخلية",
     *      "members":[],
     *  }
     * }
     */
   public function show(Committee $committee): JsonResponse
   {
       try {
           return $this->respondWithModel($committee->load($this->relations));
       }catch (Exception $e) {
           return $this->respondWithError($e->getMessage());
       }
   }
}
