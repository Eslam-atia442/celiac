<?php

namespace App\Services;

use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\RoleContract;

class RoleService extends BaseService
{

    protected BaseContract $repository;

    public function __construct(RoleContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

}
