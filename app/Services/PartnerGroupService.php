<?php

namespace App\Services;

use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\PartnerGroupContract;

class PartnerGroupService extends BaseService
{

    protected BaseContract $repository;

    public function __construct(PartnerGroupContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

}
