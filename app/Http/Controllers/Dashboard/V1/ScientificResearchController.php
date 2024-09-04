<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Enums\FileEnum;
use App\Models\HealthLibrary;
use Illuminate\Http\JsonResponse;
use App\Enums\HealthLibraryTypeEnum;
use App\Services\HealthLibraryService;
use App\Http\Controllers\BaseApiController;
use App\Http\Resources\HealthLibraryResource;
use App\Http\Requests\ScientificResearchRequest;

/**
 * @group Dashboard
 * @subgroup Scientific Research
 */

class ScientificResearchController extends BaseApiController
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
        $this->relations = ['image', 'file'];
        $this->type = FileEnum::file_type_health_library_file->value;
        $this->path = config('filesystems.upload.paths.scientific_researches');
        parent::__construct($service, HealthLibraryResource::class, 'scientific-research');
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
     *      "description" :"",
     *   }
     * }
     *
     */
    public function index():mixed
    {
        \request()->merge(['type' => HealthLibraryTypeEnum::scientific_research->value]);
        $models = $this->service->search([], $this->relations);
        return $this->respondWithCollection($models);
    }

    /**
     * Store
     *
     * @bodyParam title string required
     * @bodyParam description text required
     * @bodyParam author_name string required
     * @bodyParam image file required
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

    public function store(ScientificResearchRequest $request): JsonResponse
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
     * @urlParam $scientific_research
     * @bodyParam title string required
     * @bodyParam description text required
     * @bodyParam author_name string required
     * @bodyParam image file required
     * @bodyParam file file required
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "title" :"eman mahmoud",
     *      "description" :"",
     *   }
     * }
     *
     */
    public function update(ScientificResearchRequest $request, HealthLibrary $scientific_research): JsonResponse
    {
        try {
            $scientific_research = $this->service->updateHealthLibrary($scientific_research, $request->validated(), $this->type, $this->path);
            return $this->respondWithModel($scientific_research->load($this->relations));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Delete
     *
     * @urlParam $scientific_research
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *
     * }
     *
     */
    public function destroy(HealthLibrary $scientific_research): JsonResponse
    {
        try {
            $this->service->remove($scientific_research);
            return $this->respondWithSuccess(__('messages.responses.deleted'));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


    /**
     * change status
     *
     * @urlParam $scientific_research
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
    public function changeActivation(HealthLibrary $scientific_research): JsonResponse
    {
        try {
            $this->service->toggleField($scientific_research, 'is_active');
            return $this->respondWithModel($scientific_research->load($this->relations));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
