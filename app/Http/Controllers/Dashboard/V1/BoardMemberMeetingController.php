<?php

namespace App\Http\Controllers\Dashboard\V1;


use App\Enums\FileEnum;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\BoardMeetingRequest;
use App\Http\Resources\FileResource;
use App\Models\File;
use App\Services\FileService;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
 * @subgroup Board of Directors
 */
class BoardMemberMeetingController extends BaseApiController
{
    public string $type;
    public string $path;

    /**
     * FileController constructor.
     * @param FileService $service
     */

    public function __construct(FileService $service)
    {
        $this->relations = [];
        $this->service = $service;
        $this->type = FileEnum::file_type_board_of_directors_file->value;
        $this->path = config('filesystems.upload.paths.board_of_managers_meetings');
        \request()->merge(['type' => $this->type]);
        parent::__construct($service, FileResource::class, 'board-director-meeting');
    }

    /**
     * Board Directories Files List
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"",
     *      "url" :"",
     *  }
     * }
     */

    public function index(): mixed
    {
        $models = $this->service->search();
        return $this->respondWithCollection($models);
    }

    /**
     * Board Directories File Store
     *
     * @bodyParam name string required
     * @bodyParam file file required
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *    "id": 1
     *   }
     * }
     *
     */

    public function store(BoardMeetingRequest $request): JsonResponse
    {
        try {
            $file = $this->service->createFile($request->file, $request->validated(), $this->type, $this->path);
            return $this->respondWithModel($file);
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     *Board Directories File Update
     *
     * @bodyParam name string required
     * @bodyParam file file optional
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *    "id": 1
     *   }
     * }
     *
     */
    public function update(BoardMeetingRequest $request, File $file): JsonResponse
    {
        try {
            $file = $this->service->updateFile($file, $request->validated(), $this->type, $this->path, $request['file'] ?? '');
            return $this->respondWithModel($file);
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Board Directories File Delete
     *
     * @urlParam file integer required
     *
     * @response {
     *  "status": 200,
     *  "message": "deleted successfully",
     * }
     *
     */
    public function destroy(File $file): JsonResponse
    {
        try {
            $this->service->remove($file);
            return $this->respondWithSuccess(__('messages.responses.deleted'));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
