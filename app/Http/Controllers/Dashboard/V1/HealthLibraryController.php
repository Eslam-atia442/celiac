<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\HealthLibraryRequest;
use App\Http\Resources\HealthLibraryResource;
use App\Models\HealthLibrary;
use App\Services\HealthLibraryService;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
 * @subgroup HealthLibrary
 */

class HealthLibraryController extends BaseApiController
{
     /**
        * HealthLibraryController constructor.
        * @param HealthLibraryService $service
        */


       public function __construct(HealthLibraryService $service)
       {
           $this->service = $service;
           parent::__construct($service, HealthLibraryResource::class);
       }

    /**
     * Store a newly created resource in storage.
     * @param HealthLibraryRequest $request
     * @return JsonResponse
     */
    public function store(HealthLibraryRequest $request): JsonResponse
    {
        try {
            $healthLibrary = $this->service->create($request->validated());
            return $this->respondWithModel($healthLibrary->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
   /**
    * Display the specified resource.
    * @param HealthLibrary $healthLibrary
    * @return JsonResponse
    */
   public function show(HealthLibrary $healthLibrary): JsonResponse
   {
       try {
           return $this->respondWithModel($healthLibrary->load($this->relations));
       }catch (Exception $e) {
           return $this->respondWithError($e->getMessage());
       }
   }
    /**
     * Update the specified resource in storage.
     *
     * @param HealthLibraryRequest $request
     * @param HealthLibrary $healthLibrary
     * @return JsonResponse
     */
    public function update(HealthLibraryRequest $request, HealthLibrary $healthLibrary) : JsonResponse
    {
        try {
            $healthLibrary = $this->service->update($healthLibrary, $request->validated());
            return $this->respondWithModel($healthLibrary->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     * @param HealthLibrary $healthLibrary
     * @return JsonResponse
     */
    public function destroy(HealthLibrary $healthLibrary): JsonResponse
    {
        try {
            $this->service->remove($healthLibrary);
            return $this->respondWithSuccess(__('messages.deleted'));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * active & inactive the specified resource from storage.
     * @param HealthLibrary $healthLibrary
     * @return JsonResponse
     */
    public function changeActivation(HealthLibrary $healthLibrary): JsonResponse
    {
        try {
            $this->service->toggleField($healthLibrary, 'is_active');
            return $this->respondWithModel($healthLibrary->load($this->relations));
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
