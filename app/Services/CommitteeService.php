<?php

namespace App\Services;

use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\CommitteeContract;
class CommitteeService extends BaseService
{
    protected BaseContract $repository;

    public function __construct(CommitteeContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    public function updateCommitteeTasks($attributes){
        $this->repository->updateCommitteeTasks($attributes);
    }
}
