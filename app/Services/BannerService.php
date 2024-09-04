<?php

namespace App\Services;

use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\BannerContract;

class BannerService extends BaseService
{

    protected BaseContract $repository;

    public function __construct(BannerContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    public function createBanner($request , $type , $path = '')
    {
        $banner = $this->repository->create($request);
        app(FileService::class)->createFile($request['image'], $request, $type, $banner, $path);
        return $banner;
    }

    public function updateBanner($modelObject, $request, $type, $path = '')
    {
        $banner = $this->repository->update($modelObject, $request);
        app(FileService::class)->updateFile($modelObject->image, $request, $type, $path, $request['image']??'');
        return $banner;
    }

}
