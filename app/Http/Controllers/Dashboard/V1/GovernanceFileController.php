<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Enums\FileEnum;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\GovernanceFileRequest;
use App\Http\Resources\FileResource;
use App\Models\File;
use App\Services\FileService;
use App\Services\GovernanceListService;
use Illuminate\Http\JsonResponse;

/**
 * @group Dashboard
 * @subgroup Governance
 */
class GovernanceFileController extends BaseApiController
{
    public string $type;
    public string $path;

    /**
     * FileController constructor.
     * @param \App\Services\FileService $service
     */

    public function __construct(FileService $service)
    {
        $this->relations = [];
        $this->service = $service;

        $this->type = FileEnum::file_type_governance_attachments->value;
        $this->path = config('filesystems.upload.paths.governance_lists');
        \request()->merge(['type' => $this->type, 'fileId' => \request()->route('governanceList')]);
        parent::__construct($service, FileResource::class, 'governance-file');
    }

    /**
     * Governance Files By Governance Id
     *
     * @urlParam governanceList integer
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
        $check = app(GovernanceListService::class)->find(\request()->route('governanceList'));
        if(!$check){
            return  $this->respondWithError('', 404);
        }
        $models = $this->service->search();
        return $this->respondWithCollection($models);
    }

    /**
     * Store Governance File
     *
     * @bodyParam name string required
     * @bodyParam file file required
     * @bodyParam governance_list_id integer required
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

    public function store(GovernanceFileRequest $request): JsonResponse
    {
        try {
            $governance = app(GovernanceListService::class)->find($request->governance_list_id);
            $file = $this->service->createFile($request->file, $request->validated(), $this->type, $governance, $this->path);
            return $this->respondWithModel($file);

        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Update Governance File
     *
     * @urlParam $file
     * @bodyParam name string required
     * @bodyParam file file optional
     * @bodyParam governance_list_id integer required
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *    "id": 1
     *   }
     * }
     *
     */
    public function update(GovernanceFileRequest $request, File $file): JsonResponse
    {
        try {
            $file = $this->service->updateFile($file, $request->validated(), $this->type, $this->path, $request['file']);
            return $this->respondWithModel($file);
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Delete Governance File
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
