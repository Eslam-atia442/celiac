<?php

namespace App\Services;

use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\PermissionContract;

class PermissionService extends BaseService
{

    protected BaseContract $repository;

    public function __construct(PermissionContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

}
