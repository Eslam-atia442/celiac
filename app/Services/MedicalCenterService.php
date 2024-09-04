<?php

namespace App\Services;

use App\Enums\FileEnum;
use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\MedicalCenterContract;

class MedicalCenterService extends BaseService
{

    protected BaseContract $repository;

    public function __construct(MedicalCenterContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    public function create($request)
    {
        $data = $this->repository->create($request);
        if (array_key_exists('image', $request)) {
            app(FileService::class)->createFile($request['image'], $request, FileEnum::file_type_medical_center_image->value, $data, 'medical_center');
        }
        if (array_key_exists('pdf', $request)) {
            app(FileService::class)->createFile($request['pdf'], $request, FileEnum::file_type_medical_center_pdf->value, $data, 'medical_center');
        }
        return $data;
    }

    public function update($modelObject, $request)
    {
        $data = $this->repository->update($modelObject, $request);
        app(FileService::class)->updateFile($modelObject->image, $request, FileEnum::file_type_medical_center_image->value, 'medical_center', $request['image'] ?? '');
        app(FileService::class)->updateFile($modelObject->pdf, $request, FileEnum::file_type_medical_center_pdf->value, 'medical_center', $request['image'] ?? '');
        return $data;
    }

}
