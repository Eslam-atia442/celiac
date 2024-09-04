<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Enums\FileEnum;
use App\Models\HealthLibrary;
use Illuminate\Http\JsonResponse;
use App\Enums\HealthLibraryTypeEnum;
use App\Services\HealthLibraryService;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\GuidanceManualRequest;
use App\Http\Requests\TranslatedBookRequest;
use App\Http\Resources\HealthLibraryResource;

/**
 * @group Dashboard
 * @subgroup Guidance Manual
 */

class GuidanceManualController extends BaseApiController
{
    public string $type;
    public string $path;
    /**
     * ScientificResearchController constructor.
     * @param HealthLibraryService $service
     */

    public function __construct(HealthLibraryService $service)
    {
        $this->service = $service;
        $this->relations = ['file'];
        $this->type = FileEnum::file_type_health_library_file->value;
        $this->path = config('filesystems.upload.paths.guidance_manual');//, 'general-assembly-HealthLibrary'
        parent::__construct($service, HealthLibraryResource::class, 'guidance-manual');
    }

    /**
     * List
     *
     * @queryParam filters[keyword] Filter by name, position.
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "title" :"eman mahmoud",
     *   }
     * }
     *
     */
    public function index():mixed
    {
        \request()->merge(['type' => HealthLibraryTypeEnum::guidance_manual->value]);
        $models = $this->service->search([], $this->relations);
        return $this->respondWithCollection($models);
    }

    /**
     * Store
     *
     * @bodyParam title string required
     * @bodyParam file_type radio required Example [1=>general - 2=>Gluten sensitivity]
     * @bodyParam file file required
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "title" :"eman mahmoud",
     *   }
     * }
     *
     */

    public function store(GuidanceManualRequest $request): JsonResponse
    {
        try {
            $healthLibrary = $this->service->createHealthLibrary($request->validated(), $this->type, $this->path);
            return $this->respondWithModel($healthLibrary->load($this->relations));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Update
     *
     * @urlParam guidance_manual
     * @bodyParam title string required
     * @bodyParam file_type radio required Example [1=>general - 2=>Gluten sensitivity]
     * @bodyParam file file required
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "title" :"eman mahmoud",
     *   }
     * }
     *
     */
    public function update(GuidanceManualRequest $request, HealthLibrary $guidance_manual): JsonResponse
    {
        try {
            $guidance_manual = $this->service->updateHealthLibrary($guidance_manual, $request->validated(), $this->type, $this->path);
            return $this->respondWithModel($guidance_manual->load($this->relations));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Delete
     *
     * @urlParam $guidance_manual
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *
     * }
     *
     */
    public function destroy(HealthLibrary $guidance_manual): JsonResponse
    {
        try {
            $this->service->remove($guidance_manual);
            return $this->respondWithSuccess(__('messages.responses.deleted'));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


    /**
     * change status
     *
     * @urlParam $guidance_manual
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "title" :"eman mahmoud",
     *   }
     * }
     *
     */
    public function changeActivation(HealthLibrary $guidance_manual): JsonResponse
    {
        try {
            $this->service->toggleField($guidance_manual, 'is_active');
            return $this->respondWithModel($guidance_manual->load($this->relations));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
