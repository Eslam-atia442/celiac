<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Api
 * @subgroup Post
 */

class PostController extends BaseApiController
{
     /**
        * PostController constructor.
        * @param PostService $service
        */


       public function __construct(PostService $service)
       {
           $this->service = $service;
           parent::__construct($service, PostResource::class);
       }
    /**
     * Posts List
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
        request()->merge(['page' => false, 'limit'=> false]);
        $models = $this->service->search([], $this->relations);
        return $this->respondWithCollection($models);
    }
}
