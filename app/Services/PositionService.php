<?php

namespace App\Services;

use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\PositionContract;

class PositionService extends BaseService
{

    protected BaseContract $repository;

    public function __construct(PositionContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }


}
