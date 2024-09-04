<?php

namespace App\Services;

use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\DonationTypeContract;

class DonationTypeService extends BaseService
{

    protected BaseContract $repository;

    public function __construct(DonationTypeContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

}
