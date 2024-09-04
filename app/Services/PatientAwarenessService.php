<?php

namespace App\Services;

use App\Enums\FileEnum;
use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\PatientAwarenessContract;

class PatientAwarenessService extends BaseService
{

    protected BaseContract $repository;

    public function __construct(PatientAwarenessContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    public function createPatientAwareness($request, $type_image, $type_pdf, $path = '')
    {
        $patientAwareness = $this->repository->create($request);
        app(FileService::class)->createFile($request['image'], $request, $type_image, $patientAwareness, $path);
        if (array_key_exists('image', $request)) {
            app(FileService::class)->createFile($request['image'], $request, FileEnum::file_type_patient_awareness_image->value, $patientAwareness, $path);
        }

        app(FileService::class)->createFile($request['pdf'], $request, $type_pdf, $patientAwareness, $path);
        if (array_key_exists('pdf', $request)) {
            app(FileService::class)->createFile($request['pdf'], $request, FileEnum::file_type_patient_awareness_pdf->value, $patientAwareness, $path);
        }

        return $patientAwareness;
    }

    public function updatePatientAwareness($modelObject, $request, $type_image ,$type_pdf, $path = '')
    {
        $patientAwareness = $this->repository->update($modelObject, $request);
        app(FileService::class)->updateFile($modelObject->image, $request, $type_image, $path, $request['file'] ?? '');

        if (array_key_exists('image', $request)) {
            if (is_null($modelObject->image)) {
                $request['fileable_id'] = $modelObject->id;
                $request['fileable_type'] = class_basename($modelObject);
            }
            app(FileService::class)->updateFile($modelObject->image, $request, FileEnum::file_type_patient_awareness_image->value, $path, $request['image'] ?? '');
        }

        app(FileService::class)->updateFile($modelObject->image, $request, $type_pdf, $path, $request['file'] ?? '');

        if (array_key_exists('pdf', $request)) {
            if (is_null($modelObject->pdf)) {
                $request['fileable_id'] = $modelObject->id;
                $request['fileable_type'] = class_basename($modelObject);
            }
            app(FileService::class)->updateFile($modelObject->pdf, $request, FileEnum::file_type_patient_awareness_pdf->value, $path, $request['pdf'] ?? '');
        }
        return $patientAwareness;
    }

}
