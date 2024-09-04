<?php

namespace App\Services;

use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\ClinicContract;

class ClinicService extends BaseService
{

    protected BaseContract $repository;

    public function __construct(ClinicContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }


}
