<?php

namespace App\Services;

use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\CountryContract;

class CountryService extends BaseService
{

    protected BaseContract $repository;

    public function __construct(CountryContract $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

}
