<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Enums\FileEnum;
use App\Models\HealthLibrary;
use Illuminate\Http\JsonResponse;
use App\Enums\HealthLibraryTypeEnum;
use App\Services\HealthLibraryService;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\TranslatedBookRequest;
use App\Http\Resources\HealthLibraryResource;
/**
 * @group Dashboard
 * @subgroup Translated Book
 */

class TranslatedBookController extends BaseApiController
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
        $this->path = config('filesystems.upload.paths.translated_books');//, 'general-assembly-HealthLibrary'
        parent::__construct($service, HealthLibraryResource::class, 'translated-book');
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
        \request()->merge(['type' => HealthLibraryTypeEnum::translated_book->value]);
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

    public function store(TranslatedBookRequest $request): JsonResponse
    {
        try {
            $translated_book = $this->service->createHealthLibrary($request->validated(), $this->type, $this->path);
            return $this->respondWithModel($translated_book->load($this->relations));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Update
     *
     * @urlParam $translated_book
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
    public function update(TranslatedBookRequest $request, HealthLibrary $translated_book): JsonResponse
    {
        try {
            $translated_book = $this->service->updateHealthLibrary($translated_book, $request->validated(), $this->type, $this->path);
            return $this->respondWithModel($translated_book->load($this->relations));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Delete
     *
     * @urlParam $translated_book
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *
     * }
     *
     */
    public function destroy(HealthLibrary $translated_book): JsonResponse
    {
        try {
            $this->service->remove($translated_book);
            return $this->respondWithSuccess(__('messages.responses.deleted'));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


    /**
     * change status
     *
     * @urlParam $translated_book
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"eman mahmoud",
     *   }
     * }
     *
     */
    public function changeActivation(HealthLibrary $translated_book): JsonResponse
    {
        try {
            $this->service->toggleField($translated_book, 'is_active');
            return $this->respondWithModel($translated_book->load($this->relations));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
