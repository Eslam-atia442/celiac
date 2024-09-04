<?php

namespace App\Services;

use App\Enums\FileEnum;
use App\Models\File;
use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\FileContract;
use App\Repositories\Contracts\GovernanceListContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class FileService extends BaseService
{
    protected BaseContract $repository;

    public function __construct(FileContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    public function getMeetingFilesByType($type)
    {
        return $this->repository->getMeetingFilesByType($type);
    }

    public function createFile(UploadedFile $file, $request, $type, $fileable = null, $path = '')
    {
        $request['type'] = $type;
        $request['folder'] = $path;

        if ($fileable instanceof Model) {
            $request['fileable_id'] = $fileable->id;
            $request['fileable_type'] = class_basename($fileable);
        }
        return $this->repository->createFile($file, $request);
    }

    public function updateFile($model = null, $request, $type, $path = '', $newFile = null)
    {

        $request['type'] = $type;
        $request['folder'] = $path;
         if (is_null($model)) {
             return $this->repository->createFile($newFile, $request);
        } else {
             return $this->repository->updateFile($model, $request, $newFile);
        }
    }
}
