<?php

namespace App\Services;

use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\DonationContract;

class DonationService extends BaseService
{

    protected BaseContract $repository;

    public function __construct(DonationContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    public function createDonation($request, $type, $path = '')
    {
        $donation = $this->repository->create($request);
        app(FileService::class)->createFile($request['image'], $request, $type, $donation, $path);
        return $donation;
    }

    public function updateDonation($modelObject, $request, $type, $path = '')
    {
        $donation = $this->repository->update($modelObject, $request);
        app(FileService::class)->updateFile($modelObject->image, $request, $type, $path, $request['image'] ?? '');
        return $donation;
    }

}
