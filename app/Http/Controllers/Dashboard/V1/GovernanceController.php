<?php

namespace App\Http\Controllers\Dashboard\V1;


use App\Http\Controllers\BaseApiController;
use App\Http\Resources\GovernanceListResource;
use App\Models\GovernanceList;
use App\Services\GovernanceListService;
use Illuminate\Http\JsonResponse;


/**
 * @group Dashboard
 * @subgroup Governance
 */

class GovernanceController extends BaseApiController
{
     /**
        * CommitteeController constructor.
        * @param GovernanceListService $service
        */

       public function __construct(GovernanceListService $service)
       {
           $this->service = $service;
           $this->limit = request()->limit??10;
           parent::__construct($service, GovernanceListResource::class, 'governance-list');
       }

    /**
     * Governance List
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"القوائم المالية",
     *      "attachments":[],
     *  }
     * }
     */
    public function index(): mixed
    {
        $this->relations = ['activeFiles'];
        request()->merge(['page' => false, 'limit'=> false, 'withActiveFileCount'=> true]);
        $models = $this->service->search();
        return $this->respondWithCollection($models);
    }

    /**
     * Display the specified resource.
     * @param  GovernanceList  $governanceList
     * @return JsonResponse
     */
    public function show(GovernanceList $governanceList): JsonResponse
    {
        try {
            return $this->respondWithModel($governanceList);
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


}
