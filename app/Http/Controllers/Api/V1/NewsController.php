<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\NewsRequest;
use App\Http\Resources\NewsResource;
use App\Models\News;
use App\Services\NewsService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Api
 * @subgroup News
 */

class NewsController extends BaseApiController
{
     /**
        * NewsController constructor.
        * @param NewsService $service
        */


       public function __construct(NewsService $service)
       {
           $this->service = $service;
           $this->relations = ['image'];
           parent::__construct($service, NewsResource::class);
       }
    /**
     * Newss List
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"",
     *      "description" :"",
     *      "date" :""
     *      "image" :""
     *  }
     * }
     */
    public function index(): mixed
    {
        $models = $this->service->search([], $this->relations);
        return $this->respondWithCollection($models);
    }
}
