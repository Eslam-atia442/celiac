<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Enums\JobRequestStatusEnum;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\JobRequestRequest;
use App\Http\Resources\JobRequestResource;
use App\Models\JobRequest;
use App\Services\JobRequestService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Dashboard
 * @subgroup JobRequest
 */

class JobRequestController extends BaseApiController
{
     /**
        * JobRequestController constructor.
        * @param JobRequestService $service
        */


       public function __construct(JobRequestService $service)
       {
           $this->service = $service;
           $this->relations = ['user','cv'];
           parent::__construct($service, JobRequestResource::class);
       }


    /**
     * Display a listing of pending job requests
     *
     *
     */
    public function index(): mixed
    {
        request()->merge([ 'statusSearch' => JobRequestStatusEnum::pending->value ]);
        $models = $this->service->search([], $this->relations);
        return $this->respondWithCollection($models);
    }

    /**
     * Display a listing of accepted job requests
     *
     *
     */

    public function acceptedJobs()
    {
        request()->merge([ 'statusSearch' => JobRequestStatusEnum::accepted->value ]);
        $models = $this->service->search([], $this->relations);
        return $this->respondWithCollection($models);
    }

    /**
     * Store a newly created resource in storage.
     * @param JobRequestRequest $request
     * @return JsonResponse
     */
    public function store(JobRequestRequest $request): JsonResponse
    {
        try {
            $jobRequest = $this->service->create($request->validated());
            return $this->respondWithModel($jobRequest->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
   /**
    * Display the specified resource.
    * @param JobRequest $jobRequest
    * @return JsonResponse
    */
   public function show(JobRequest $jobRequest): JsonResponse
   {
       try {
           return $this->respondWithModel($jobRequest->load($this->relations));
       }catch (Exception $e) {
           return $this->respondWithError($e->getMessage());
       }
   }
    /**
     * Update the specified resource in storage.
     *
     * @param JobRequestRequest $request
     * @param JobRequest $jobRequest
     * @return JsonResponse
     */
    public function update(JobRequestRequest $request, JobRequest $jobRequest) : JsonResponse
    {
        try {
            $jobRequest = $this->service->update($jobRequest, $request->validated());
            return $this->respondWithModel($jobRequest->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     * @param JobRequest $jobRequest
     * @return JsonResponse
     */
    public function destroy(JobRequest $jobRequest): JsonResponse
    {
        try {
            $this->service->remove($jobRequest);
            return $this->respondWithSuccess(__('messages.deleted'));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * active & inactive the apply for hajj.
     *
     *
     */
    public function changeSettings(Request $request): JsonResponse
    {
        try {
            $this->service->changeSettings();
            return $this->respondWithSuccess(__('messages.responses.updated'));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
