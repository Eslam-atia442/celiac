<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\FileRequest;
use App\Http\Resources\FileResource;
use App\Models\File;
use App\Repositories\Contracts\FileContract;
use App\Services\FileService;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * @group Dashboard
 * @subgroup Files
 */
class FileController extends BaseApiController
{
    /**
     * FileController constructor.
     * @param \App\Services\FileService $service
     */


    public function __construct(FileService $service)
    {
        $this->service = $service;
        parent::__construct($service, FileResource::class);
    }

    /**
     * Upload new file
     * @header Authorization @{{token}}
     * @bodyParam file required The uploaded file.
     * @bodyParam type string required The file type. (meeting attachment -> request_meeting_attachment)
     * <p>Available types:</p>
     * <p><code>user_avatar => To upload user avatar</code></p>
     *
     * @param FileRequest $request
     * @return JsonResponse
     *
     * @unauthenticated
     */
    public function store(FileRequest $request): JsonResponse
    {
        try {
            $file = $this->service->create($request->validated());
            return $this->respondWithModel($file);
        }catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Delete File
     *
     * @param File $file
     * @return JsonResponse
     *
     * @unauthenticated
     */
    public function destroy(File $file): JsonResponse
    {
        try{
            $this->service->remove($file);
            return $this->respondWithSuccess(__('Deleted Successfully'));
        }catch(Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function show(File $file): BinaryFileResponse|JsonResponse
    {
        try{
            $path = storage_path('app/public/'.$file->url);
            if (!file_exists($path)) {
                return $this->respondWithError(__('File not found'));
            }
            $base64 = base64_encode(file_get_contents($path));
            return response()->json(['data' => $base64, 'mime' => $file->mime, 'name' => $file->original_name]);
        }catch(Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

}
