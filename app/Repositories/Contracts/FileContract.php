<?php

namespace App\Repositories\Contracts;

use App\Models\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

interface FileContract extends BaseContract
{
    public function getMeetingFilesByType($type);
    public function createFile(UploadedFile $file, $request): File;
    public function updateFile($model, array $attributes = [], $newFile=null);//: mixed;
}

