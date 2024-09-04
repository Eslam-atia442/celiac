<?php

namespace App\Services;

use App\Enums\FileEnum;
use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\HealthLibraryContract;

class HealthLibraryService extends BaseService
{

    protected BaseContract $repository;

    public function __construct(HealthLibraryContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }
    public function createHealthLibrary($request, $type, $path = '')
    {
        $healthLibrary = $this->repository->create($request);
        app(FileService::class)->createFile($request['file'], $request, $type, $healthLibrary, $path);
        if(array_key_exists('image', $request)){
            app(FileService::class)->createFile($request['image'], $request, FileEnum::file_type_health_library_image?->value, $healthLibrary, $path);
        }
        return $healthLibrary;
    }

    public function updateHealthLibrary($modelObject, $request, $type, $path = '')
    {
        $healthLibrary = $this->repository->update($modelObject, $request);
        app(FileService::class)->updateFile($modelObject->file, $request, $type, $path, $request['file'] ?? '');
        if(array_key_exists('image', $request)){
            if(is_null($modelObject->image)){
                $request['fileable_id'] = $modelObject->id;
                $request['fileable_type'] = class_basename($modelObject);
            }
            app(FileService::class)->updateFile($modelObject->image, $request, FileEnum::file_type_health_library_image?->value, $path, $request['image'] ?? '');
        }
        return $healthLibrary;
    }

    public function checkLibraryExist($title, $id = null)
    {
        return $this->repository->checkLibraryExist($title, $id);

    }

}
