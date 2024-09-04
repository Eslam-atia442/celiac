<?php

namespace App\Services;

use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\GovernanceListContract;

class GovernanceListService extends BaseService
{
    protected BaseContract $repository;

    public function __construct(GovernanceListContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

}
