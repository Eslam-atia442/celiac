<?php

namespace App\Services;

use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\PartnerContract;

class PartnerService extends BaseService
{

    protected BaseContract $repository;

    public function __construct(PartnerContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    public function createPartner($request, $type, $path = '')
    {
        $partner = $this->repository->create($request);
        app(FileService::class)->createFile($request['image'], $request, $type, $partner, $path);
        return $partner;
    }

    public function updatePartner($modelObject, $request, $type, $path = '')
    {
        $partner = $this->repository->update($modelObject, $request);
        app(FileService::class)->updateFile($modelObject->image, $request, $type, $path, $request['image'] ?? '');
        return $partner;
    }


}
