<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\CommitteeRequest;
use App\Http\Requests\UpdateAllCommitteeTasksRequest;
use App\Http\Requests\UpdateCommitteeTasksRequest;
use App\Http\Resources\CommitteeResource;
use App\Models\Committee;
use App\Services\CommitteeService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
 * @subgroup Committees
 */

class CommitteeController extends BaseApiController
{
     /**
        * CommitteeController constructor.
        * @param CommitteeService $service
        */


       public function __construct(CommitteeService $service)
       {
           $this->service = $service;
           parent::__construct($service, CommitteeResource::class, 'committee');
       }

    /**
     * Lists
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"لجنة المخاطر",
     *      "description" :"لجنة المخاطر",
     *      "mainIcon" :"",
     *      "icon" :"",
     *  }
     * }
     */
    public function index(): mixed
    {
        request()->merge(['page' => false, 'limit' => false]);
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
           return $this->respondWithModel($committee->load(['mainIcon', 'icon', 'members']));
       }catch (Exception $e) {
           return $this->respondWithError($e->getMessage());
       }
   }
    /**
     * Committee Update
     *
     * @bodyParam tasks text required
     *
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
    public function update(UpdateCommitteeTasksRequest $request, Committee $committee) : JsonResponse
    {
        try {
            $committee = $this->service->update($committee, $request->validated());
            return $this->respondWithModel($committee->load(['mainIcon', 'icon', 'members']));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Update All Committee
     *
     * @bodyParam committees array required Example [ [ 'id'=> 1, 'tasks'=> 'test'] ]
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     * }
     */
    public function updateAll(UpdateAllCommitteeTasksRequest $request)
    {
        $this->service->updateCommitteeTasks($request->validated());
        return $this->respondWithSuccess(__("Committee tasks updated"));
    }

}
